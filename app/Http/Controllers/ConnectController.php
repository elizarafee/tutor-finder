<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Tutor;
use App\Student;
use App\Connection;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use App\Mail\RequestToConnect;
use App\Mail\RequestAccepted;

/**
 * Takes care of connect requests 
 */
class ConnectController extends Controller
{
    /**
     * Showing list of connected user with logged in user
     * (tutor or guardian)
     */
    public function connections()
    {
        $user = Auth::user(); // logged in user
        $connections = array();
        
        // adding user id from requests accepted by logged in user
        $requested_to = Connection::whereNotNull('connections.accepted_at')
        ->where('connections.request_to', $user->id)
        ->get(['requested_by as user']);
        
        if ($requested_to->count()>0) {
            foreach ($requested_to as $request) {
                $connections[] = $request->user;
            }
        }

        // adding user id from requests accepted by other user
        $requested_by = Connection::whereNotNull('connections.accepted_at')
        ->where('connections.requested_by', $user->id)
        ->get(['request_to as user']);
        
        if ($requested_by->count()>0) {
            foreach ($requested_by as $request) {
                $connections[] = $request->user;
            }
        }

        if ($user->type == 2) {
            $data = array(
                'students.id as id',
                'users.id as user_id',
                'users.picture as picture',
                'users.first_name',
                'users.last_name',
                'users.approved_at',
                'students.location',
                'students.budget',
                'students.bio',
                'students.year_of_birth',
                'students.gender',
                'students.class',
                'students.institute',
                'students.subjects',
           );

            $students = Student::join('users', 'users.id', 'students.user_id')
           ->whereIn('users.id', $connections)
            ->whereNotNull('users.approved_at')
            ->where('users.type', 3)
            ->orderBy('users.approved_at', 'desc')
            ->get($data);

            return view('connects.tutors.connections', ['students' => $students]);
        } elseif ($user->type == 3) {
            $data = array(
                'tutors.id as id',
                'users.id as user_id',
                'users.picture as picture',
                'users.first_name',
                'users.last_name',
                'users.approved_at',
                'tutors.locations',
                'tutors.salary',
                'tutors.bio',
                'tutors.year_of_birth',
                'tutors.gender',
                'tutors.covered_subjects',
                'tutor_qualifications.institute',
                'tutor_qualifications.subject',
                'tutor_qualifications.status',
           );

            $tutors = Tutor::join('users', 'users.id', 'tutors.user_id')
           ->join('tutor_qualifications', 'tutor_qualifications.tutor_id', 'tutors.id')
           ->whereIn('users.id', $connections)
            ->whereNotNull('users.approved_at')
            ->where('users.type', 2)
            ->orderBy('users.approved_at', 'desc')
            ->get($data);

            return view('connects.students.connections', ['tutors' => $tutors]);
        }
    }

    /**
     * Shows pending requests received by logged in user
     * (tutor or guardian)
     */
    public function requests()
    {
        $user = Auth::user(); // logged in user
        $requests = false;
        if ($user->type == 2) {
            $requests = Student::join('users', 'users.id', 'students.user_id')
            ->join('connections', 'users.id', 'connections.requested_by')
            ->where('connections.request_to', $user->id)
            ->whereNull('connections.accepted_at')
            ->get(['connections.id as id', 'students.id as student_id', 'users.first_name', 'users.last_name', 'connections.created_at']);

            return view('connects.tutors.requests', ['requests' => $requests]);
        } elseif ($user->type == 3) {
            $requests = Tutor::join('users', 'users.id', 'tutors.user_id')
            ->join('connections', 'users.id', 'connections.requested_by')
            ->where('connections.request_to', $user->id)
            ->whereNull('connections.accepted_at')
            ->get(['connections.id as id', 'tutors.id as tutor_id', 'users.first_name', 'users.last_name', 'connections.created_at']);
        
            return view('connects.students.requests', ['requests' => $requests]);
        }
    }

    /**
     * Store and send email to connect with other user
     *
     * @param int $request_to user id of requesting to connect
     *
     * @return Redirect
     */
    public function connect($request_to)
    {
        DB::beginTransaction();
        try {
            $connection_data = array(
                'request_to' => $request_to,
                'requested_by' => Auth::user()->id,
            );
    
            Connection::create($connection_data);

            $user = User::find($request_to);
            $requested_by = Auth::user()->first_name.' '.Auth::user()->last_name;
            Mail::to($user->email)->send(new RequestToConnect($user, $requested_by));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to send the request. Please try again.');
        }

        DB::commit();
        return redirect()->back()->with('success', 'Connection request successfully sent.');
    }


    /**
     * Cancels request to connect
     *
     * @param int $request_to user id of requested to connect
     *
     * @return Redirect
     */
    public function cancel($request_to)
    {
        $cancel = Connection::where('request_to', $request_to)
        ->where('requested_by', Auth::user()->id)
        ->delete();

        if ($cancel) {
            return redirect()->back()->with('success', 'Connection request successfully cancelled.');
        }

        return redirect()->back()->with('error', 'Failed to cancel the request. Please try again.');
    }

    /**
     * Disconnects from a connected user
     *
     * @param int $requested_by already connected user id
     *
     * @return Redirect
     */
    public function disconnect($requested_by)
    {
        $user = Auth::user(); // logged in user
        $disconnect = Connection::where('request_to', $user->id)
        ->where('requested_by', $requested_by)
        ->whereNotNull('accepted_at')
        ->delete();

        if ($disconnect) {
            if ($user->type == 2) {
                return redirect('/students')->with('success', 'Successfully disconnected.');
            } elseif ($user->type == 3) {
                return redirect('/tutors')->with('success', 'Successfully disconnected.');
            }
        }

        return redirect()->back()->with('error', 'Failed to disconnect. Please try again.');
    }

    /**
     * Accept request to connect
     *
    * @param int $requested_by user id who wants to connect
     *
     * @return Redirect
     */
    public function accept($requested_by)
    {
        DB::beginTransaction();
        try {
            Connection::where('request_to', Auth::user()->id)
        ->where('requested_by', $requested_by)
        ->update(['accepted_at' => date('Y-m-d H:i:s')]);

            $user = User::find($requested_by);
            $accepted_by = Auth::user()->first_name.' '.Auth::user()->last_name;
            Mail::to($user->email)->send(new RequestAccepted($user, $accepted_by));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to accept the request. Please try again.');
        }

        DB::commit();
        return redirect()->back()->with('success', 'Connection request successfully accepted.');
    }


    /**
     * Rejects request to connect
     *
     * @param int $requested_by user id who wants to connect
     *
     * @return Redirect
     */

    public function reject($requested_by)
    {
        $user = Auth::user(); // logged in user
        $delete = Connection::where('request_to', $user->id)
        ->where('requested_by', $requested_by)
        ->delete();

        if ($delete) {
            if ($user->type == 2) {
                return redirect('/students')->with('success', 'Connection request successfully rejected.');
            } elseif ($user->type == 3) {
                return redirect('/tutors')->with('success', 'Connection request successfully rejected.');
            }
        }

        return redirect()->back()->with('error', 'Failed to reject the request. Please try again.');
    }
}

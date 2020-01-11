<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Connection;
use App\Student;
use App\Tutor;
use App\User;
use Illuminate\Support\Facades\Auth;


class ConnectController extends Controller
{
    public function connections() 
    {
        $user = Auth::user();
        $connections = array(); 
        
        $requested_to = Connection::whereNotNull('connections.accepted_at')
        ->where('connections.request_to', $user->id)
        ->get(['requested_by as user']);
        
        if($requested_to->count()>0) {
            foreach($requested_to as $request) {
                $connections[] = $request->user;
            }
        }

        $requested_by = Connection::whereNotNull('connections.accepted_at')
        ->where('connections.requested_by', $user->id)
        ->get(['request_to as user']);
        
        if($requested_by->count()>0) {
            foreach($requested_by as $request) {
                $connections[] = $request->user;
            }
        }

        if($user->type == 2) {
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

        } elseif($user->type == 3) {

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

    public function requests()
    {
        $user = Auth::user();
        $requests = false;
        if($user->type == 2) {
            
            $requests = Student::join('users', 'users.id', 'students.user_id')
            ->join('connections', 'users.id', 'connections.requested_by')
            ->where('connections.request_to', $user->id)
            ->whereNull('connections.accepted_at')
            ->get(['connections.id as id', 'students.id as student_id', 'users.first_name', 'users.last_name', 'connections.created_at']);

            return view('connects.tutors.requests', ['requests' => $requests]);
        
        } elseif($user->type == 3) {

            $requests = Tutor::join('users', 'users.id', 'tutors.user_id')
            ->join('connections', 'users.id', 'connections.requested_by')
            ->where('connections.request_to', $user->id)
            ->whereNull('connections.accepted_at')
            ->get(['connections.id as id', 'tutors.id as tutor_id', 'users.first_name', 'users.last_name', 'connections.created_at']);
        
            return view('connects.students.requests', ['requests' => $requests]);
        
        }

        
    }

    public function connect($user_id)
    {
        $connection_data = array(
            'request_to' => $user_id,
            'requested_by' => Auth::user()->id,
        );

        $connection = Connection::create($connection_data);

        if($connection) {
            return redirect()->back()->with('success', 'Connection request successfully sent.');
        }

        return redirect()->back()->with('error', 'Failed to send the request. Please try again.');
    }

    public function cancel($user_id)
    {
        $cancel = Connection::where('request_to', $user_id)
        ->where('requested_by', Auth::user()->id)
        ->delete();

        if($cancel) {
            return redirect()->back()->with('success', 'Connection request successfully cancelled.');
        }

        return redirect()->back()->with('error', 'Failed to cancel the request. Please try again.');
    }

    public function disconnect($user_id)
    {
        $user = Auth::user();
        $disconnect = Connection::where('request_to', $user->id)
        ->where('requested_by', $user_id)
        ->whereNotNull('accepted_at')
        ->delete();

        if($disconnect) {
            if($user->type == 2) {
                return redirect('/students')->with('success', 'Successfully disconnected.');
            } elseif($user->type == 3) {
                return redirect('/tutors')->with('success', 'Successfully disconnected.');
            } 
        }

        return redirect()->back()->with('error', 'Failed to disconnect. Please try again.');
    }

    public function accept($user_id)
    {
        $accept = Connection::where('request_to', Auth::user()->id)
        ->where('requested_by', $user_id)
        ->update(['accepted_at' => date('Y-m-d H:i:s')]);

        if($accept) {
            return redirect()->back()->with('success', 'Connection request successfully accepted.');
        }

        return redirect()->back()->with('error', 'Failed to accept the request. Please try again.');
    }

    public function reject($user_id) 
    {
        $user = Auth::user();
        $delete = Connection::where('request_to', $user->id)
        ->where('requested_by', $user_id)
        ->delete();

        if($delete) {
            if($user->type == 2) {
                return redirect('/students')->with('success', 'Connection request successfully rejected.');
            } elseif($user->type == 3) {
                return redirect('/tutors')->with('success', 'Connection request successfully rejected.');
            } 
        }

        return redirect()->back()->with('error', 'Failed to reject the request. Please try again.');
    }
}

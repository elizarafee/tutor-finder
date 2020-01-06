<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Connection;
use App\Student;
use Illuminate\Support\Facades\Auth;


class ConnectionController extends Controller
{
    public function index() 
    {
       
        $user = Auth::user();
        $connections = array(); 
        
        $requested_to = Connection::whereNotNull('connections.approved_at')
        ->where('connections.request_to', $user->id)
        ->get(['requested_by as user']);
        
        if($requested_to->count()>0) {
            foreach($requested_to as $request) {
                $connections[] = $request->user;
            }
        }

        $requested_by = Connection::whereNotNull('connections.approved_at')
        ->where('connections.requested_by', $user->id)
        ->get(['request_to as user']);
        
        if($requested_by->count()>0) {
            foreach($requested_by as $request) {
                $connections[] = $request->user;
            }
        }

        $requests = false;
        $students = false;
        $tutors = false;
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
                'students.doy', 
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

            $requests = Connection::join('users', 'users.id', 'connections.request_to')
            ->join('students', 'users.id', 'students.user_id')
            ->whereNull('connections.approved_at')
            ->where('connections.request_to', $user->id)
            ->get(['students.id as student_id', 'users.first_name', 'users.last_name']);

        } elseif($user->type == 3) {

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
                'students.doy', 
                'students.gender', 
                'students.class', 
                'students.institute', 
                'students.subjects', 
           );

           $tutors = Student::join('users', 'users.id', 'students.user_id')
           ->whereIn('users.id', $connections)
            ->whereNotNull('users.approved_at')
            ->where('users.type', 3)
            ->orderBy('users.approved_at', 'desc')
            ->get($data);

            $requests = Connection::join('users', 'users.id', 'connections.request_to')
            ->join('students', 'users.id', 'students.user_id')
            ->whereNull('connections.approved_at')
            ->where('connections.request_to', $user->id)
            ->get(['students.id as student_id', 'users.first_name', 'users.last_name']);

        }

        

        return view('connections.index', ['requests' => $requests, 'tutors' => $tutors, 'students' => $students]);
    }

    public function connect($request_to)
    {
        $connection_data = array(
            'request_to' => $request_to,
            'requested_by' => Auth::user()->id,
        );

        $connection = Connection::create($connection_data);

        if($connection) {
            return redirect()->back()->with('success', 'Connection request successfully sent.');
        }

        return redirect()->back()->with('error', 'Failed to send the request. Please try again.');
    }

    public function cancel($request_to)
    {
        $cancel = Connection::where('request_to', $request_to)
        ->where('requested_by', Auth::user()->id)
        ->delete();

        if($cancel) {
            return redirect()->back()->with('success', 'Connection request successfully cancelled.');
        }

        return redirect()->back()->with('error', 'Failed to cancel the request. Please try again.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Tutor;
use App\TutorQualification;
use App\Student;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index() 
    {
        $tutors = User::join('tutors', 'tutors.user_id', 'users.id')
        ->where('users.type', 2)
        ->whereNotNull('completed_at')
        ->whereNull('rejected_at')
        ->whereNull('approved_at')
        ->get(['users.id as user_id', 'users.first_name', 'users.last_name', 'tutors.id as id', 'users.completed_at']);

        $students = User::join('students', 'students.user_id', 'users.id')
        ->where('users.type', 3)
        ->whereNotNull('completed_at')
        ->whereNull('rejected_at')
        ->whereNull('approved_at')
        ->get(['users.id as user_id', 'users.first_name', 'users.last_name', 'students.id as id', 'users.completed_at']);

        return view('profiles.index', ['tutors' => $tutors, 'students' => $students]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();

        $type = $user->type;
        $completed_profile = $user->completed_at;
        
        if($type == 1) {
            // Admin
            return view('profiles.admin', ['user' => $user]);
        } elseif($type == 2) {
            // Tutor 
            $tutor = Tutor::where('user_id', $user->id)->first();
                if($tutor) {
                    $qualification = TutorQualification::where('tutor_id', $tutor->id)->first();
                    if ($completed_profile != '') {
                        return view('profiles.tutor', ['user' => $user, 'tutor' => $tutor, 'qualification' => $qualification]);
                    } else {
                        return view('tutors.edit', ['user' => $user]);
                    }
                } else {
                    return view('tutors.create', ['user' => $user]);
            }
        } elseif($type == 3) {
            // Student Guardian 
            $student = student::where('user_id', $user->id)->first();
                if($student) {
                    if ($completed_profile != '') {
                        return view('profiles.student', ['user' => $user, 'student' => $student]);
                    } else {
                        return view('students.edit', ['user' => $user]);
                    }
                } else {
                    return view('students.create', ['user' => $user]);
            }
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approved($user_id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disapprove($user_id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        //
    }
}

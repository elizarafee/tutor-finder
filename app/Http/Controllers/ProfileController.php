<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Tutor;
use App\Student;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $type = $user->type;
        $completed_profile = $user->profile_completed_at;
        
        if($type == 1) {
            // Admin
            return view('profiles.admin', ['user' => $user]);
        } elseif($type == 2) {
            // Tutor 
            $tutor = Tutor::where('user_id', $user->id)->first();
                if($tutor) {
                    if ($completed_profile != '') {
                        return view('profiles.tutor', ['user' => $user, 'tutor' => $tutor]);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

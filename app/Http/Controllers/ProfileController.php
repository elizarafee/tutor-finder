<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\User;
use App\Tutor;
use App\TutorQualification;
use App\Student;
use App\Connection;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileApproved;
use App\Mail\ProfileDisapproved;

class ProfileController extends Controller
{
    public function review()
    {
        $tutors['awaiting'] = User::join('tutors', 'tutors.user_id', 'users.id')
        ->where('users.type', 2)
        ->whereNotNull('completed_at')
        ->whereNull('rejected_at')
        ->whereNull('approved_at')
        ->get(['users.id as user_id', 'users.first_name', 'users.last_name', 'tutors.id as id', 'users.completed_at']);

        $tutors['rejected'] = User::join('tutors', 'tutors.user_id', 'users.id')
        ->where('users.type', 2)
        ->whereNotNull('completed_at')
        ->whereNotNull('rejected_at')
        ->get(['users.id as user_id', 'users.first_name', 'users.last_name', 'tutors.id as id', 'users.rejected_at', 'users.rejection_reason']);

        $students['awaiting'] = User::join('students', 'students.user_id', 'users.id')
        ->where('users.type', 3)
        ->whereNotNull('completed_at')
        ->whereNull('rejected_at')
        ->whereNull('approved_at')
        ->get(['users.id as user_id', 'users.first_name', 'users.last_name', 'students.id as id', 'users.completed_at']);

        $students['rejected'] = User::join('students', 'students.user_id', 'users.id')
        ->where('users.type', 3)
        ->whereNotNull('completed_at')
        ->whereNotNull('rejected_at')
        ->get(['users.id as user_id', 'users.first_name', 'users.last_name', 'students.id as id', 'users.rejected_at', 'users.rejection_reason']);

        return view('profiles.review.index', ['tutors' => $tutors, 'students' => $students]);
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
        
        if ($type == 1) {
            // Admin
            return view('profiles.admin', ['user' => $user]);
        } elseif ($type == 2) {
            // Tutor
            $tutor = Tutor::where('user_id', $user->id)->first();
            if ($tutor) {
                $qualification = TutorQualification::where('tutor_id', $tutor->id)->first();
                return view('profiles.tutor', ['user' => $user, 'tutor' => $tutor, 'qualification' => $qualification]);
            } else {
                return view('tutors.create', ['user' => $user]);
            }
        } elseif ($type == 3) {
            // Student Guardian
            $student = student::where('user_id', $user->id)->first();
            if ($student) {
                return view('profiles.student', ['user' => $user, 'student' => $student]);
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
    public function approve($user_id)
    {
        DB::beginTransaction();
        try {
            User::where('id', $user_id)->update([
                'reviewed' => 1,
                'approved_at' => date('Y-m-d H:i:s'),
                'approved_by' => Auth::user()->id,
                'rejected_at' => null,
                'rejected_by' => null,
                'rejection_reason' => null
            ]);

            $user = User::find($user_id);

            // profile approved
            Mail::to($user->email)->send(new ProfileApproved($user));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('profiles/review')->with('error', 'Failed to approved the profile. Please try again.'.$e->getMessage());
        }
        DB::commit();
        return redirect('profiles/review')->with('success', 'Profile of '.$user->first_name.' '.$user->last_name.' successfully approved.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disapprove(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->with('error', 'Please provide the reason for disapproving the profile.');
        }

        DB::beginTransaction();
        try {
            User::where('id', $user_id)->update([
                'reviewed' => 1,
                'approved_at' => null,
                'approved_by' => null,
                'rejected_at' => date('Y-m-d H:i:s'),
                'rejected_by' => Auth::user()->id,
                'rejection_reason' => $request->get('reason')
            ]);

            $user = User::find($user_id);

            // profile disapproved
            Mail::to($user->email)->send(new ProfileDisapproved($user));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('profiles/review')->with('error', 'Failed to disapproved the profile. Please try again.'.$e->getMessage());
        }
        DB::commit();
        return redirect('profiles/review')->with('success', 'Profile of '.$user->first_name.' '.$user->last_name.' successfully disapproved.');
    }

    public function activate()
    {
        $activate = User::where('id', Auth::id())->update(['active' => 1]);

        if($activate) {
            return redirect()->back()->with('success', 'Your profile successfully activated.');
        }

        return redirect()->back()->with('error', 'Failed to activate. Please try again.');
    }

    public function deactivate()
    {
        $activate = User::where('id', Auth::id())->update(['active' => 0]);

        if($activate) {
            return redirect()->back()->with('success', 'Your profile successfully deactivated.');
        }

        return redirect()->back()->with('error', 'Failed to deactivate. Please try again.');

    }

}

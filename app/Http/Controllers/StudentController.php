<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Student;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreStudentRequest;

use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileUpdated;
use App\Mail\ReviewProfile;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'students.id as id',
            'users.id as user_id',
            'users.picture as picture', 
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
        ->select($data)
        ->whereNotNull('users.approved_at')
        ->where('users.type', 3)
        ->orderBy('users.approved_at', 'desc')
        ->paginate(10);
        return view('students.index', ['students' => $students]);
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
    public function store(StoreStudentRequest $request)
    {
        $user = Auth::user();

        DB::beginTransaction();
        try {

            $student_data = array(
                'user_id' => Auth::user()->id,
                'bio' => $request->get('bio'),
                'gender' => $request->get('gender'),
                'doy' => $request->get('year_of_birth'),
                'class' => $request->get('class'),
                'institute' => $request->get('institute'),
                'subjects' => $request->get('subjects'),
                'location' => $request->get('location'),
                'budget' => $request->get('budget'),
                'requirements' => $request->get('requirements'),
            );

            Student::create($student_data);

            $picture = null;
            if($request->has('picture')) {
                $picture = $request->file('picture')->store('storage/docs/'.$user->id.'/profiles', 'public');
            } 
            $proof_of_id = $request->file('proof_of_id')->store('storage/docs/'.$user->id.'/proof_of_ids', 'public');

            $user_data = array(
                'picture' => $picture,
                'proof_of_id' => $proof_of_id,
                'mobile' => $request->get('mobile'),
                'completed_at' => date('Y-m-d H:i:s')
            );

            User::where('id', $user->id)->update($user_data);

            // profile updated
            Mail::to($user->email)->send(new ProfileUpdated($user));
        
            // review profile
            Mail::to('eliza@tutorfinder.com')->send(new ReviewProfile($user));

        } catch(\Exception $e) {
            DB::rollBack();
            Storage::deleteDirectory('storage/docs/'.$user->id);
            return redirect('/profile')->with('error', 'Failed to update profile. Please try again.('.$e->getMessage().')');
        }

        DB::commit();
        return redirect('/profile')->with('success', 'Profile successfully updated. Admin will review to approve it.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        $data = array(
             'users.id as user_id', 
             'users.first_name as user_first_name', 
             'users.last_name as user_last_name', 
             'users.email as user_email', 
             'users.mobile as user_mobile', 
             'users.picture as user_picture', 
             'users.proof_of_id as user_proof_of_id', 
             'users.approved_at',
             'users.type as user_type',
             'students.id as id', 
             'students.location', 
             'students.budget', 
             'students.bio', 
             'students.doy', 
             'students.gender', 
             'students.class', 
             'students.institute', 
             'students.subjects', 
             'students.requirements', 
        );

        $student = Student::join('users', 'users.id', 'students.user_id')
        ->where('students.id', $student_id)
        ->first($data);

        return view('students.show', ['student' => $student]);
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

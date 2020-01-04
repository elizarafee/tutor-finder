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
        //
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
                $picture = $request->file('picture')->store('public/docs/'.$user->id.'/profiles');
            } 
            $proof_of_id = $request->file('proof_of_id')->store('public/docs/'.$user->id.'/proof_of_ids');

            $user_data = array(
                'picture' => $picture,
                'proof_of_id' => $proof_of_id,
                'mobile' => $request->get('mobile'),
                'profile_completed_at' => date('Y-m-d H:i:s')
            );

            User::where('id', $user->id)->update($user_data);

            // profile updated
            Mail::to($user->email)->send(new ProfileUpdated($user));
        
            // review profile
            Mail::to('eliza@tutorfinder.com')->send(new ReviewProfile($user));

        } catch(\Exception $e) {
            DB::rollBack();
            Storage::deleteDirectory('docs/'.$user->id);
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

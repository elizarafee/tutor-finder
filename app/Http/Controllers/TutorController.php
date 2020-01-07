<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Tutor;
use App\TutorQualification;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreTutorRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileUpdated;
use App\Mail\ReviewProfile;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'tutors.id as id',
            'users.id as user_id',
            'users.first_name',
            'users.last_name',
            'users.picture as picture', 
            'users.approved_at',
            'tutors.salary', 
            'tutors.bio', 
            'tutors.doy', 
            'tutors.gender',  
            'tutors.locations', 
            'tutors.covered_subjects', 
            'tutor_qualifications.institute',
            'tutor_qualifications.subject',
            'tutor_qualifications.status',
       );

        $tutors = Tutor::join('users', 'users.id', 'tutors.user_id')
        ->join('tutor_qualifications', 'tutors.id', 'tutor_qualifications.tutor_id')
        ->select($data)
        ->whereNotNull('users.approved_at')
        ->where('users.type', 2)
        ->orderBy('users.approved_at', 'desc')
        ->paginate(10);
        
        return view('tutors.index', ['tutors' => $tutors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTutorRequest $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";

        $user = Auth::user();

        DB::beginTransaction();
        try {

            $tutor_data = array(
                'user_id' => Auth::user()->id,
                'bio' => $request->get('bio'),
                'gender' => $request->get('gender'),
                'doy' => $request->get('year_of_birth'),
                'covered_subjects' => $request->get('subjects'),
                'covered_area' => $request->get('areas'),
                'covered_years' => $request->get('years'),
                'salary' => $request->get('salary'),
            );

            $tutor = Tutor::create($tutor_data);

            $tutor_qualification_data = array(
                'tutor_id' => $tutor->id,
                'level' => $request->get('level'),
                'subject' => $request->get('subject'),
                'institute' => $request->get('institute'),
                'status' => $request->get('status'),
                'note' => $request->get('note'),
            );

            $tutor_qualification = TutorQualification::create($tutor_qualification_data);

            $proof_of_doc = $request->file('proof_of_doc')->store('docs/'.$user->id.'/qualifications/'.$tutor_qualification->id, 'public');
            TutorQualification::where('id', $tutor_qualification->id)->update(['proof_of_doc' => $proof_of_doc]);

            $picture = null;
            if($request->has('picture')) {
                $picture = $request->file('picture')->store('docs/'.$user->id.'/profiles', 'public');
            } 
            $proof_of_id = $request->file('proof_of_id')->store('docs/'.$user->id.'/proof_of_ids', 'public');

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
    public function show($tutor_id)
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
            'tutors.id as id', 
            'tutors.bio', 
            'tutors.doy', 
            'tutors.gender', 
            'tutors.locations', 
            'tutors.covered_subjects', 
            'tutors.covered_years',
            'tutors.salary',  
            'tutor_qualifications.level',
            'tutor_qualifications.subject', 
            'tutor_qualifications.institute', 
            'tutor_qualifications.status', 
            'tutor_qualifications.proof_of_doc',
            'tutor_qualifications.note',
       );

       $tutor = Tutor::join('users', 'users.id', 'tutors.user_id')
       ->join('tutor_qualifications', 'tutors.id', 'tutor_qualifications.tutor_id')
       ->where('tutors.id', $tutor_id)
       ->first($data);

       return view('tutors.show', ['tutor' => $tutor]);
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
    public function update(Request $request)
    {
        echo "update";
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

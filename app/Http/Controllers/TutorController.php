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
        $tutors = Tutor::join('users', 'users.id', 'tutors.user_id')->select(['tutors.id as id', 'users.*', 'tutors.*'])->paginate(10);
        return view('tutors.index', ['tutors' => $tutors]);
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

            $proof_of_doc = $request->file('proof_of_doc')->store('public/docs/'.$user->id.'/qualifications/'.$tutor_qualification->id);
            TutorQualification::where('id', $tutor_qualification->id)->update(['proof_of_doc' => $proof_of_doc]);

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

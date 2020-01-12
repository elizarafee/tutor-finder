<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\User;
use App\Tutor;
use App\TutorQualification;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreTutorRequest;
use App\Http\Requests\UpdateTutorRequest;
use App\Http\Requests\SearchTutorRequest;

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
            'tutors.year_of_birth', 
            'tutors.gender',  
            'tutors.locations', 
            'tutors.covered_subjects', 
            'tutors.covered_years', 
            'tutor_qualifications.level',
            'tutor_qualifications.institute',
            'tutor_qualifications.subject',
            'tutor_qualifications.status',
       );

        $tutors = Tutor::join('users', 'users.id', 'tutors.user_id')
        ->join('tutor_qualifications', 'tutors.id', 'tutor_qualifications.tutor_id')
        ->select($data)
        ->whereNotNull('users.approved_at')
        ->where('users.type', 2)
        ->where('users.active', 1)
        ->orderBy('users.approved_at', 'desc')
        ->paginate(10);
        
        return view('tutors.index', ['tutors' => $tutors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(SearchTutorRequest $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";

        if ($request->isMethod('post')) {
            Session::forget('conditions');
        }

        $conditions = array();
        if ($request->get('class') != "") {
            $conditions[] = ['tutors.covered_years', '=', $request->get('class')];
        }

        if ($request->get('subject') != "") {
            $conditions[] = ['tutors.covered_subjects', 'like', '%' . ($request->get('subject')) . '%'];
        }

        if ($request->get('location') != "") {
            $conditions[] = ['tutors.locations', 'like', '%' . ($request->get('location')) . '%'];
        }

        if ($request->get('salary') != "") {
            $conditions[] = ['tutors.salary', '<=', $request->get('salary')];
        }

        if ($request->get('status') != "") {
            $conditions[] = ['tutor_qualifications.status', '=', $request->get('status')];
        }

        if ($request->get('level') != "") {
            $conditions[] = ['tutor_qualifications.level', '=', $request->get('level')];
        }

        if(count($conditions) > 0) {
            Session::put('conditions', $conditions);
            
            $inputs = $request->all();
            unset($inputs['_token']);
            Session::put('input', $inputs);
        }

        $data = array(
            'tutors.id as id',
            'users.id as user_id',
            'users.first_name',
            'users.last_name',
            'users.picture as picture', 
            'users.approved_at',
            'tutors.salary', 
            'tutors.bio', 
            'tutors.year_of_birth', 
            'tutors.gender',  
            'tutors.locations', 
            'tutors.covered_years', 
            'tutors.covered_subjects', 
            'tutor_qualifications.level',
            'tutor_qualifications.institute',
            'tutor_qualifications.subject',
            'tutor_qualifications.status',
       );

        $tutors = Tutor::join('users', 'users.id', 'tutors.user_id')
        ->join('tutor_qualifications', 'tutors.id', 'tutor_qualifications.tutor_id')
        ->select($data)
        ->whereNotNull('users.approved_at')
        ->where('users.type', 2)
        ->where('users.active', 1)
        ->where(Session::get('conditions'))
        ->orderBy('users.approved_at', 'desc')
        ->paginate(10);
 
       
        return view('tutors.index', ['tutors' => $tutors, 'page_title' => 'Searched Tutors', 'input' => Session::get('input')]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTutorRequest $request)
    {

        $user = Auth::user();
        DB::beginTransaction();
        try {
            $tutor_data = array(
                'user_id' => Auth::user()->id,
                'bio' => $request->get('bio'),
                'gender' => $request->get('gender'),
                'year_of_birth' => $request->get('year_of_birth'),
                'covered_subjects' => $request->get('subjects'),
                'locations' => $request->get('locations'),
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
            Mail::to(developer('email'))->send(new ReviewProfile($user));

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
            'users.reviewed',
            'users.type as user_type',
            'tutors.id as id', 
            'tutors.bio', 
            'tutors.year_of_birth', 
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

       $connection = has_connection($tutor->user_id);
       if(Auth::user()->type == 1 || $connection['connected'] || $connection['request'] == 'received') {
            return view('tutors.show', ['tutor' => $tutor, 'connection' => $connection]);
       }

       return redirect('/tutors')->with('warning', 'You are not connected with '.$tutor->user_first_name.' '.$tutor->user_last_name);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
            'users.reviewed',
            'users.type as user_type',
            'tutors.id as id', 
            'tutors.bio', 
            'tutors.year_of_birth', 
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
       ->where('users.id', Auth::id())
       ->first($data);

        return view('tutors.edit', ['tutor' => $tutor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTutorRequest $request)
    {

        $user = Auth::user();
        $tutor = Tutor::join('users', 'users.id', 'tutors.user_id')
       ->join('tutor_qualifications', 'tutors.id', 'tutor_qualifications.tutor_id')
       ->where('users.id', Auth::id())
       ->first(['users.id as user_id', 'tutors.id as tutor_id', 'tutor_qualifications.id as qualification_id', 'tutor_qualifications.proof_of_doc']);


        DB::beginTransaction();
        try {
            $tutor_data = array(
                'bio' => $request->get('bio'),
                'gender' => $request->get('gender'),
                'year_of_birth' => $request->get('year_of_birth'),
                'covered_subjects' => $request->get('subjects'),
                'locations' => $request->get('locations'),
                'covered_years' => $request->get('years'),
                'salary' => $request->get('salary'),
            );

            $tutor_qualification_data = array(
                'level' => $request->get('level'),
                'subject' => $request->get('subject'),
                'institute' => $request->get('institute'),
                'status' => $request->get('status'),
                'note' => $request->get('note'),
            );

            $user_data = array(
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'mobile' => $request->get('mobile'),
                'completed_at' => date('Y-m-d H:i:s'),
                'reviewed' => 0,
                'approved_at' => null,
                'rejected_at' => null,
                'rejection_reason' => null,
            );

            if($request->has('picture')) {
                $picture = $request->file('picture')->store('docs/'.$user->id.'/profiles', 'public');
                
                if($picture) {
                    $old_pp = Storage::disk('public')->exists($user->picture);
                    if($old_pp) {
                        Storage::disk('public')->delete($user->picture);
                    }
                }

                $user_data['picture'] = $picture;
            } 

            if($request->has('proof_of_id')) {
                $proof_of_id = $request->file('proof_of_id')->store('docs/'.$user->id.'/proof_of_ids', 'public');
            
                if($proof_of_id) {
                    $old_poi = Storage::disk('public')->exists($user->proof_of_id);
                    if($old_poi) {
                        Storage::disk('public')->delete($user->proof_of_id);
                    }
                }
                $user_data['proof_of_id'] = $proof_of_id;
            }

            if($request->has('proof_of_doc')) {
                $proof_of_doc = $request->file('proof_of_doc')->store('docs/'.$user->id.'/qualifications/'.$tutor->qualification_id, 'public');
            
                if($proof_of_doc) {
                    $old_pod = Storage::disk('public')->exists($tutor->proof_of_doc);
                    if($old_pod) {
                        Storage::disk('public')->delete($tutor->proof_of_doc);
                    }
                }
                $tutor_qualification_data['proof_of_doc'] = $proof_of_doc;
            }

            TutorQualification::where('id', $tutor->qualification_id)->update($tutor_qualification_data);
            Tutor::where('id', $tutor->tutor_id)->update($tutor_data);
            User::where('id', $user->id)->update($user_data);

            // profile updated
            Mail::to($user->email)->send(new ProfileUpdated($user));
        
            // review profile
            Mail::to(developer('email'))->send(new ReviewProfile($user));

        } catch(\Exception $e) {
            DB::rollBack();
            Storage::deleteDirectory('docs/'.$user->id);
            return redirect('/profile')->with('error', 'Failed to update profile. Please try again.('.$e->getMessage().')');
        }

        DB::commit();
        return redirect('/profile')->with('success', 'Profile successfully updated. Admin will review to approve it.');
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

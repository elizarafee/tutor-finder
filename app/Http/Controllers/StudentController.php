<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Student;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\SearchStudentRequest;

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
            'users.first_name',
            'users.last_name',
            'users.picture as picture', 
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
        ->select($data)
        ->whereNotNull('users.approved_at')
        ->where('users.type', 3)
        ->where('users.active', 1)
        ->orderBy('users.approved_at', 'desc')
        ->paginate(10);
        
        return view('students.index', ['students' => $students, 'page_title' => 'All Students']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(SearchStudentRequest $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";

        if ($request->isMethod('post')) {
            Session::forget('conditions');
        }

        $conditions = array();
        if ($request->get('class') != "") {
            $conditions[] = ['students.class', '=', $request->get('class')];
        }

        if ($request->get('subject') != "") {
            $conditions[] = ['students.subjects', 'like', '%' . ($request->get('subject')) . '%'];
        }

        if ($request->get('location') != "") {
            $conditions[] = ['students.location', '=', $request->get('location')];
        }

        if ($request->get('budget') != "") {
            $conditions[] = ['students.budget', '<=', $request->get('budget')];
        }

        if(count($conditions) > 0) {
            Session::put('conditions', $conditions);
            
            $inputs = $request->all();
            unset($inputs['_token']);
            Session::put('input', $inputs);
        }

        $data = array(
            'students.id as id',
            'users.id as user_id',
            'users.first_name',
            'users.last_name',
            'users.picture as picture', 
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
        ->select($data)
        ->whereNotNull('users.approved_at')
        ->where('users.type', 3)
        ->where('users.active', 1)
        ->where(Session::get('conditions'))
        ->orderBy('users.approved_at', 'desc')
        ->paginate(10);
        
        return view('students.index', ['students' => $students, 'page_title' => 'Searched Students', 'input' => Session::get('input')]);

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
                'year_of_birth' => $request->get('year_of_birth'),
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
                $picture = $request->file('picture')->store('docs/'.$user->id.'/profiles', 'public');
            } 
            $proof_of_id = $request->file('proof_of_id')->store('docs/'.$user->id.'/proof_of_ids', 'public');

            $user_data = array(
                'picture' => $picture,
                'proof_of_id' => $proof_of_id,
                'mobile' => $request->get('mobile'),
                'completed_at' => date('Y-m-d H:i:s')
            );

            User::where('id', $user->id)->update($user_data);

            // profile updated
            //Mail::to($user->email)->send(new ProfileUpdated($user));
        
            // review profile
            //Mail::to(developer('email'))->send(new ReviewProfile($user));

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
             'users.first_name as first_name', 
             'users.last_name as last_name', 
             'users.email as email', 
             'users.mobile as mobile', 
             'users.picture as picture', 
             'users.proof_of_id as proof_of_id', 
             'users.reviewed',
             'users.approved_at',
             'users.type as user_type',
             'students.id as id', 
             'students.location', 
             'students.budget', 
             'students.bio', 
             'students.year_of_birth', 
             'students.gender', 
             'students.class', 
             'students.institute', 
             'students.subjects', 
             'students.requirements', 
        );

        $student = Student::join('users', 'users.id', 'students.user_id')
        ->where('students.id', $student_id)
        ->first($data);

        $connection = has_connection($student->user_id);

       if(Auth::user()->type == 1 || $connection['connected'] || $connection['request'] == 'received') {
            return view('students.show', ['student' => $student, 'connection' => $connection]);
       }

       return redirect('/students')->with('warning', 'You are not connected with this student');
       
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
            'users.first_name as first_name', 
            'users.last_name as last_name', 
            'users.email as email', 
            'users.mobile as mobile', 
            'users.picture as picture', 
            'users.proof_of_id as proof_of_id', 
            'users.reviewed',
            'users.approved_at',
            'users.type as user_type',
            'students.id as id', 
            'students.location', 
            'students.budget', 
            'students.bio', 
            'students.year_of_birth', 
            'students.gender', 
            'students.class', 
            'students.institute', 
            'students.subjects', 
            'students.requirements', 
       );

        $student = Student::join('users', 'users.id', 'students.user_id')
        ->where('users.id', Auth::id())
        ->where('users.type', 3)
        ->first($data);

        return view('students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request)
    {
       
        $user = Auth::user();

        DB::beginTransaction();
        try {

            $student_data = array(
                'bio' => $request->get('bio'),
                'gender' => $request->get('gender'),
                'year_of_birth' => $request->get('year_of_birth'),
                'class' => $request->get('class'),
                'institute' => $request->get('institute'),
                'subjects' => $request->get('subjects'),
                'location' => $request->get('location'),
                'budget' => $request->get('budget'),
                'requirements' => $request->get('requirements'),
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

            $proof_of_id = null;
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
            

            Student::where('user_id', $user->id)->update($student_data);
            User::where('id', $user->id)->update($user_data);

            // profile updated
            //Mail::to($user->email)->send(new ProfileUpdated($user));
        
            // review profile
            //Mail::to(developer('email'))->send(new ReviewProfile($user));

        } catch(\Exception $e) {
            DB::rollBack();
            return redirect('/profile')->with('error', 'Failed to update profile. Please try again.('.$e->getMessage().')');
        }

        DB::commit();
        return redirect('/profile')->with('success', 'Profile successfully updated. Admin will review to approve it.');
    }
}

@extends('layouts.app')

@section('page_title', 'About')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p class="text-justify">Private tuition is very common in our society and it is benefiting a lot of students
                to boost their ability as well as a lot of tutors to have income support. But, there are some media
                nowadays takes unfair advantages of this situation when students and tutor suffer. I have developed a
                web-based platform where guardians or students who can find available teachers registered in the
                application, as well as teacher, will find potential students. All the necessary information are nicely
                organized here. </p>

            <div class="row">
                <div class="col">
                    <img class="w-25 float-left mr-5" src="{{ url('images/student.png') }}" />
                    <h5 class="mt-3">Looking for Students?</h5>
                    <p class="text-justify">If you are a tutor and looking for potential students in Sylhet City then
                        this application will help you to find registered guardians with the student details.</p>
                    <p>It will help you find students without any other form of media and save you time and money.</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <img class="w-25 float-left mr-5" src="{{ url('images/tutor.png') }}" />
                    <h5>Looking for Tutors?</h3>
                        <p class="text-justify">If you are a guardian and looking for a qualified tutor in Sylhet City
                            then this application will help you to find registered tutors.</p>
                        <p>It will help you find tutors without any other form of media and save you time and money.</p>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
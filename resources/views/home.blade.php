@extends('layouts.app')

@section('page_title', 'Welcome to Tutor Finder')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
           <h4>An intuitive application to connect potential tutors with student's guardians.</h4>
           <img class="w-50" src="{{ url('images/connections.png') }}"/>
           <p class="mt-3">Please register and complete your profile to find and make connection with each other.</p>
        </div>
    </div>
</div>
@endsection
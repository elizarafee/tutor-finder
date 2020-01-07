@extends('layouts.app')

@section('page_title', 'Review Profiles')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @include('profiles.review.tutors.awaiting')
                    @include('profiles.review.tutors.rejected')
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @include('profiles.review.students.awaiting')
                    @include('profiles.review.students.rejected')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
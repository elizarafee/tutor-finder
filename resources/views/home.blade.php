@extends('layouts.app')

@section('content')
<div class="container">

    <!--
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
-->


    <div class="row mb-3 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 text-center text-info">
                        <i class="far fa-id-badge fa-9x"></i>
                           <!-- <a href="{{url('/tutors/1')}}">
                            <img src="{{url('/png/black/361.png')}}" class="w-100 img-thumbnail" alt="...">
                            </a> -->
                        </div>
                        <div class="col-sm-6 col-md-9">
                        
                            <ul class="list-unstyled float-left">
                                <li><span class="text-muted">Bio: </span>Bangla, English, Biology</li>
                                <li><span class="text-muted">Subjects covered: </span>Bangla, English, Biology</li>
                                <li><span class="text-muted">Area covered: </span>Bangla, English, Biology</li>
                                <li><span class="text-muted">Min expected salary: </span> 1000 taka (per month)</li>
                                <li><span class="text-muted">Hightest qualification: </span> MBBS (4th year) <span class="badge badge-info">studying</span></li>
                            </ul>
                            
                            
                        
                            <span class="badge badge-warning float-right mt-1">Request Sent</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary float-right mt-1">Request Details</button>
                            <button type="button" class="btn btn-sm btn-outline-success float-right mt-1">View Details <i class="far fa-id-card"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 text-center text-info">
                        <i class="far fa-id-badge fa-9x"></i>
                           <!-- <a href="{{url('/tutors/1')}}">
                            <img src="{{url('/png/black/361.png')}}" class="w-100 img-thumbnail" alt="...">
                            </a> -->
                        </div>
                        <div class="col-sm-6 col-md-9">
                        
                            <ul class="list-unstyled float-left">
                                <li><span class="text-muted">Bio: </span>Bangla, English, Biology</li>
                                <li><span class="text-muted">Subjects covered: </span>Bangla, English, Biology</li>
                                <li><span class="text-muted">Area covered: </span>Bangla, English, Biology</li>
                                <li><span class="text-muted">Min expected salary: </span> 1000 taka (per month)</li>
                                <li><span class="text-muted">Hightest qualification: </span> MBBS (4th year) <span class="badge badge-info">studying</span></li>
                            </ul>
                            
                            
                        
                            <span class="badge badge-warning float-right mt-1">Request Sent</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary float-right mt-1">Request Details</button>
                            <button type="button" class="btn btn-sm btn-outline-success float-right mt-1">View Details <i class="far fa-id-card"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
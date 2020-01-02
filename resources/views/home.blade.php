@extends('layouts.app')

@section('content')
<div class="container">
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



    <div class="row mb-3 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                <div class="row">
                    <div class="col-sm-6 col-md-3">
                    <img width="150" height="100" src="{{url('/png/black/361.png')}}" alt="..." class="img-thumbnail">
                    </div>
                    <div class="col-sm-6 col-md-9">
                        <ul class="list-unstyled">
                            <li>Course, Course</li>
                            <li>asdfas fasdfas fasdfasdfasdfasdf</li>
                        </ul>
                    </div>
                </div>

                    
                </div>
            </div>
        </div>
    </div>



</div>
@endsection

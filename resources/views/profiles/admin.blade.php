@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{$user->first_name}} {{$user->last_name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$user->bio}}</h6>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6 col-md-4 text-center text-info">
                        <a href="{{url('/tutors/1')}}">
                            <img src="{{url('/png/black/361.png')}}" class="w-100 img-thumbnail" alt="...">
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-8">

                        <ul class="list-unstyled float-left">
                            <li><span class="text-muted">Bio: </span>Bangla, English, Biology</li>
                            <li><span class="text-muted">Subjects covered: </span>Bangla, English, Biology</li>
                            <li><span class="text-muted">Area covered: </span>Bangla, English, Biology</li>
                            <li><span class="text-muted">Min expected salary: </span> 1000 taka (per month)</li>
                            <li><span class="text-muted">Hightest qualification: </span> MBBS (4th year) <span class="badge badge-info">studying</span></li>
                       
                       <li>

                       <button type="button" class="btn btn-sm btn-outline-info">Request Sent</span>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Request Details</button>
                        <button type="button" class="btn btn-sm btn-outline-success">View Details <i class="far fa-id-card"></i></button>
                    

                       </li>
                       
                        </ul>



                   </div>
                </div>



            </div>
        </div>
    </div>
</div>
</div>



@endsection
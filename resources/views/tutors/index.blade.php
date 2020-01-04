@extends('layouts.app')

@section('content')
<div class="container">

    {{$tutors->links()}}

    @foreach($tutors as $tutor)

    <div class="row mb-3 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 text-center text-info">
                            <!-- <i class="far fa-id-badge fa-9x"></i> -->
                            <a href="{{url('/tutors/'.$tutor->id)}}">
                                <img src="{{ asset('storage/'.$tutor->picture) }}" class="w-100 img-thumbnail" alt="...">
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-9">

                            <ul class="list-unstyled float-left">
                                <li><span class="text-muted">Bio: </span>{{$tutor->bio}}</li>
                                <li><span class="text-muted">Subjects covered: </span>{{$tutor->covered_subjects}}</li>
                                <li><span class="text-muted">Area covered: </span>{{$tutor->covered_area}}</li>
                                <li><span class="text-muted">Min expected salary: </span> {{$tutor->salary}} taka (per month)</li>
                                <li><span class="text-muted">Hightest qualification: </span> <span class="badge badge-info">{{$tutor->first_name}}</span></li>

                                <li class="mt-2">
                                    <span class="btn btn-sm btn-outline-secondary">Request Sent</span>
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

    @endforeach

    {{$tutors->links()}}
</div>


@endsection
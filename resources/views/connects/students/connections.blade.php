@extends('layouts.app')

@section('page_title', 'Connections')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            @if($tutors && $tutors->count() > 0)

            @foreach($tutors as $tutor)

            <div class="row mb-3 justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-3 text-center text-info">
                                    <a href="{{url('/tutors/'.$tutor->id)}}">
                                        @if($tutor->picture == '')
                                        <i class="far fa-id-badge fa-9x text-light"></i>
                                        @else
                                        <img src="{{ asset('storage/'.$tutor->picture) }}" class="img-thumbnail"
                                            alt="Profile Picture">
                                        @endif
                                    </a>

                                </div>
                                <div class="col-sm-6 col-md-9">
                                    <ul class="list-unstyled float-left">
                                        <li>
                                            <h6><a href="{{url('/tutors/'.$tutor->id)}}">{{$tutor->first_name}}
                                                    {{$tutor->last_name}}</a></h6>
                                        </li>


                                        <li><span class="text-muted">Subjects covered:
                                            </span>{{$tutor->covered_subjects}}</li>
                                        <li><span class="text-muted">Area covered: </span>{{$tutor->locations}}</li>
                                        <li><span class="text-muted">Expected salary: </span>&#2547;{{$tutor->salary}}
                                            <small>(per subject per
                                                month)</small></li>
                                        <li><span class="text-muted">Qualification:</span>
                                            @if($tutor->status == 'Studying')
                                            {{$tutor->status}} in {{$tutor->subject}} at {{$tutor->institute}}
                                            @elseif($tutor->status == 'Completed')
                                            {{$tutor->status}} {{$tutor->subject}} from {{$tutor->institute}}
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

            @else

            <div class="alert alert-warning text-center" role="alert">
                You don't have any connections yet!
            </div>

            @endif

        </div>
    </div>
</div>
@endsection
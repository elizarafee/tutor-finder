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

                                        <img src="{{ asset('storage/'.$tutor->picture) }}" class="img-thumbnail" alt="Profile Picture">

                                        @endif
                                    </a>

                                </div>
                                <div class="col-sm-6 col-md-9">

                                    <ul class="list-unstyled float-left">
                                        <li>
                                            <h6><a href="{{url('/tutors/'.$tutor->id)}}">{{$tutor->first_name}} {{$tutor->last_name}}</a></h6>
                                        </li>
                                        <li class="text-muted"><span class="text-dark">Location: </span>{{ $tutor->location }}</li>
                                        <li class="text-muted"><span class="text-dark">Budget: </span>&#2547;{{ $tutor->budget }} <small>(per subject per month)</small></li>
                                        <li class="text-muted"><span class="text-dark">Tution needed for: </span> {{$tutor->subjects}}</li>
                                        <li class="text-muted"><span class="text-dark">tutor status : </span> Studying in {{ years_of_study($tutor->class) }} at {{ $tutor->institute }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
            @endif 


        </div>





    </div>
</div>
@endsection
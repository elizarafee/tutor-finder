@extends('layouts.app')

@section('page_title', 'Connections')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if($requests->count() > 0)
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                <table class="table table-sm table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">You have {{ $requests->count() }} new connection request</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td>
                                    <a href="{{ url('/tutors/'.$request->id) }}">{{$request->first_name.' '.$request->last_name}}</a> 
                                    <small class="text-muted">requested at {{date('j M Y g:i a', strtotime($request->created_at))}}</small>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>


                   
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-8">

        @if($students && $students->count() > 0)
            @foreach($students as $student)

            <div class="row mb-3 justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-3 text-center text-info">
                                    <a href="{{url('/students/'.$student->id)}}">
                                        @if($student->picture == '')
                                        <i class="far fa-id-badge fa-9x text-light"></i>
                                        @else

                                        <img src="{{ asset('storage/'.$user->picture) }}" class="img-thumbnail" alt="Profile Picture">

                                        @endif
                                    </a>

                                </div>
                                <div class="col-sm-6 col-md-9">

                                    <ul class="list-unstyled float-left">
                                        <li>
                                            <h6><a href="{{url('/students/'.$student->id)}}">{{$student->first_name}} {{$student->last_name}}</a></h6>
                                        </li>
                                        <li class="text-muted"><span class="text-dark">Location: </span>{{ $student->location }}</li>
                                        <li class="text-muted"><span class="text-dark">Budget: </span>&#2547;{{ $student->budget }} <small>(per subject per month)</small></li>
                                        <li class="text-muted"><span class="text-dark">Tution needed for: </span> {{$student->subjects}}</li>
                                        <li class="text-muted"><span class="text-dark">Student status : </span> Studying in {{ years_of_study($student->class) }} at {{ $student->institute }}</li>
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
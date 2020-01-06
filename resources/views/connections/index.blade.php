@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if($requests->count() > 0)
        <div class="col-md-6">
            <div class="card bg-warning">
                <div class="card-body">

                    <pre>
    <?php print_r($requests); 
    ?>
</pre>


                    <h6>You have 3 new connection request</h6>

                    <ul>
                        @foreach($requests as $request)
                        <li><a href="">dfasdf</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-8">
            <h3 class="mt-3 text-center">My Connections</h3>
            <hr />

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


        </div>





    </div>
</div>
@endsection
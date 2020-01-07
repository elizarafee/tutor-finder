@extends('layouts.app')

@section('page_title', 'Students')

@section('content')
  {{$students->links()}}

  @foreach($students as $student)

  <div class="row mb-3 justify-content-center">
    <div class="col-md-8">
  
      <div class="card">
        <div class="card-body">
          <?php $connection = has_connection($student->user_id); ?>
          <div class="row">
            <div class="col-sm-6 col-md-3 text-center text-info">

              <a href="{{url('/students/'.$student->id)}}" class="mb-3 d-block">
                @if($student->picture == '')
                <i class="far fa-id-badge fa-6x text-light"></i>
                @else
                  <img src="{{ asset('storage/'.$user->picture) }}" class="img-thumbnail" alt="Profile Picture">
                @endif
              </a>

              @if(auth()->user()->type == 1)
                  <a href="{{ url('/students/'.$student->id) }}" class="btn btn-sm btn-outline-success">View details</a>
              @elseif(auth()->user()->type == 2)
                  @if($connection)
                    @if($connection->approved_at == "")
                      @include('students.modals.cancel')
                    @else
                      <a href="{{ url('/students/'.$student->id) }}" class="btn btn-sm btn-outline-success">View details</a>
                    @endif
                  @else
                    @include('students.modals.connect')
                  @endif
              @endif
            </div>

            <div class="col-sm-6 col-md-9">
              <ul class="list-unstyled float-left">
                @if(auth()->user()->type == 1)
                <li class="text-muted"><span class="text-dark">Guardian: </span><a href="{{url('/students/'.$student->id)}}">{{$student->first_name.' '.$student->last_name}}</a></li>
                @endif
                <li class="text-muted"><span class="text-dark">Location: </span>{{ $student->location }}</li>
                <li class="text-muted"><span class="text-dark">Budget: </span>&#2547;{{ $student->budget }} <small>(per subject per month)</small></li>
                <li class="text-muted"><span class="text-dark">Student bio <small>({{date('Y') - $student->doy}} year old {{$student->gender}})</small> : </span>{{substr($student->bio, 0, 120)}} @if(strlen($student->bio)>120) ... @endif</li>
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

  {{$students->links()}}
</div>


@endsection
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
          <div class="col-sm-6 col-md-3 text-center">
            @include('students.links')
          </div>
          <div class="col-sm-6 col-md-9">
            <ul class="list-unstyled float-left">
              @if(auth()->user()->type != 5)
              <li class="text-muted"><span class="text-dark">Guardian: {{ $student->user_id }} - {{ auth()->user()->id }} </span><a
                  href="{{url('/students/'.$student->id)}}">{{$student->first_name.' '.$student->last_name}}</a></li>
              @endif
              <li class="text-muted"><span class="text-dark">Location: </span>{{ $student->location }}</li>
              <li class="text-muted"><span class="text-dark">Budget: </span>&#2547;{{ $student->budget }} <small>(per
                  subject per month)</small></li>
              <li class="text-muted"><span class="text-dark">Student bio <small>({{date('Y') - $student->year_of_birth}} year old
                    {{$student->gender}})</small> : </span>{{substr($student->bio, 0, 120)}}
                @if(strlen($student->bio)>120) ... @endif</li>
              <li class="text-muted"><span class="text-dark">Tution needed for: </span> {{$student->subjects}}</li>
              <li class="text-muted"><span class="text-dark">Student status : </span> Studying in {{
                years_of_study($student->class) }} at {{ $student->institute }}</li>
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
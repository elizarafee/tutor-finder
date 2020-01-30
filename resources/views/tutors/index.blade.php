@extends('layouts.app')

@section('page_title', ((isset($page_title))? $page_title : 'Tutors'))

@section('content')

@include('tutors.search')
<div class="container">

  {{$tutors->links()}}

  @foreach($tutors as $tutor)

  <div class="row mb-3 justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <?php $connection = has_connection($tutor->user_id); ?>
          <div class="row">
            <div class="col-sm-6 col-md-3 text-center">
              @include('tutors.links')
            </div>
            <div class="col-sm-6 col-md-9">
              <ul class="list-unstyled float-left">
                @if(auth()->user()->type != 5)
                <li><a href="{{url('/tutors/'.$tutor->id)}}">{{$tutor->first_name.' '.$tutor->last_name}}</a></li>
                @endif
                <li><span class="text-muted">Bio <small>({{date('Y') - $tutor->year_of_birth}} year old
                      {{$tutor->gender}})</small> : </span>{{substr($tutor->bio, 0, 120)}} @if(strlen($tutor->bio)>120)
                  ... @endif</li>
                <li><span class="text-muted">Years covered: </span>{{$tutor->covered_years}}</li>

                <li><span class="text-muted">Subjects covered: </span>{{$tutor->covered_subjects}}</li>
                <li><span class="text-muted">Area covered: </span>{{$tutor->locations}}</li>
                <li><span class="text-muted">Expected salary: </span>&#2547;{{$tutor->salary}} <small>(per subject per
                    month)</small></li>
                <li><span class="text-muted">Qualification: ({{ levels_of_study($tutor->level) }})</span>
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

  {{$tutors->links()}}
</div>


@endsection
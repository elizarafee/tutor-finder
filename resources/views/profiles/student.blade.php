@extends('layouts.app')

@section('page_title', $user->first_name.' '.$user->last_name)

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      @if($user->reviewed == 1 && $user->approved_at == '')
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Your profile was rejected for {{$user->rejection_reason}} at {{date('j M Y g:ia', strtotime($user->rejected_at))}}. You can update your profile and resubmit.
      </div>
      @elseif($user->approved_at == '')
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        This profile is not yet approved.
      </div>
      @endif

      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 col-md-4 text-center text-info">

              @if($user->picture == '')
              <i class="far fa-id-badge fa-9x text-light"></i>
              @else
              <img src="{{ asset('storage/'.$user->picture) }}" class="img-thumbnail" alt="Profile Picture">
              @endif

            </div>
            <div class="col-sm-6 col-md-8">

              <ul class="list-unstyled float-left">
                <li><span class="text-muted">Location: </span>{{ $student->location }}</li>
                <li><span class="text-muted">Budget: </span>&#2547;{{ $student->budget }}</li>

                <li class="mt-4 mb-2">
                  <h6 class=" text-muted">Proof of Identification</h6>
                  <hr class="mt-0" />

                  @if($user->proof_of_id == '')
                  <i class="far fa-address-card fa-9x text-light"></i>
                  @else
                  <img src="{{ asset('storage/'.$user->proof_of_id) }}" class="img-thumbnail" alt="Profile Picture">
                  @endif
                </li>

                <li class="mt-4">
                  <h6 class="mt-4">Student Details</h6>
                  <hr class="mt-0" />
                </li>

                <li><span class="text-muted">Bio: </span>{{ $student->bio }}</li>
                <li><span class="text-muted">Age: </span>{{ date('Y') - $student->year_of_birth }}</li>
                <li><span class="text-muted">Gender: </span>{{ $student->gender }}</li>
                <li><span class="text-muted">Class: </span>{{ years_of_study($student->class) }}</li>
                <li><span class="text-muted">Institute: </span>{{ $student->institute }}</li>
                <li><span class="text-muted">Subjects need tutions: </span>{{ $student->subjects }}</li>

                @if($student->requirements != '')
                <li><span class="text-muted">Any other requirements: </span> {{ $student->requirements }}</li>
                @endif

                <li class="mt-4 mb-2">
                  <h6 class="text-muted">Contact Details</h6>
                  <hr class="mt-0" />
                </li>
                <li><span class="text-muted">Email Address: </span>{{ $user->email }}</li>
                
                @if($user->mobile != "") 
                <li><span class="text-muted">Mobile: </span> +880{{ $user->mobile }}</li>
                @endif

              </ul>
            </div>
          </div>
        </div>


        <div class="card-footer text-center pt-4 pb-4">

          @if(auth()->user()->active == 1)
            <a href="{{ url('/student/edit') }}" class="btn btn-sm btn-outline-primary mr-2">Update profile</a>
            @include('profiles.modals.deactivate')
          @else
            @include('profiles.modals.activate')
          @endif

        </div>
      </div>
    </div>
  </div>
</div>



@endsection
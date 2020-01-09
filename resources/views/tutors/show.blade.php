@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-header text-center">
          <h5 class="card-title">{{$tutor->user_first_name}} {{$tutor->user_last_name}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">Tutor</h6>
        </div>

        <div class="card-body">

          @if($connection['request'] == 'received' && $connection['connected'] == false)
          <div class="alert alert-warning" role="alert">
            {{$tutor->user_first_name}} {{$tutor->user_last_name}} requested you to connect at {{date('j M Y g:ia',
            strtotime($connection['time']))}}.
          </div>
          @endif

          <div class="row">
            <div class="col-sm-6 col-md-3 text-center">

              @if($tutor->user_picture == '')
              <i class="far fa-id-badge fa-9x text-light"></i>
              @else
              <img src="{{ asset($tutor->picture) }}" class="img-thumbnail" alt="Profile Picture">
              @endif

            </div>
            <div class="col-sm-6 col-md-9">
              <ul class="list-unstyled float-left">
                <li><span class="text-muted">Bio: </span>{{ $tutor->bio }}</li>
                <li><span class="text-muted">Gender: </span>{{ $tutor->gender }}</li>
                <li><span class="text-muted">Age: </span>{{ date('Y') - $tutor->doy }}</li>
                <li><span class="text-muted">Covered subjects: </span>{{ $tutor->covered_subjects }}</li>
                <li><span class="text-muted">Locations: </span>{{ $tutor->locations }}</li>
                <li><span class="text-muted">Expected salary: </span>&#2547;{{ $tutor->salary }}</li>

                <li class="mt-4 mb-2">
                  <h6 class="text-muted">Proof of Identification</h6>
                  <hr class="mt-0" />

                  @if($tutor->user_proof_of_id == '')
                  <i class="far fa-address-card fa-9x text-light"></i>
                  @else
                  <img src="{{ asset('storage/'.$tutor->proof_of_id) }}" class="img-thumbnail" alt="Profile Picture">
                  @endif
                </li>

                <li class="mt-4">
                  <h6 class="text-muted">Qualification</h6>
                  <hr class="mt-0" />
                </li>
                <li><span class="text-muted">Level: </span>{{ levels_of_study($tutor->level) }}</li>
                <li><span class="text-muted">Subject: </span>{{ $tutor->subject }}</li>

                <li><span class="text-muted">Institute: </span>{{ $tutor->institute }}</li>
                <li><span class="text-muted">Status: </span>{{ $tutor->status }}</li>

                @if($tutor->note != '')
                <li><span class="text-muted">Note: </span>{{ $tutor->note }}</li>
                @endif

                <li class="mt-4 mb-2">
                  <h6 class="text-muted">Proof of Document (for qualification)</h6>
                  <hr class="mt-0" />

                  @if($tutor->proof_of_doc == '')
                  <i class="far fa-image fa-9x text-light"></i>
                  @else
                  <img src="{{ asset('storage/'.$tutor->proof_of_doc) }}" class="img-thumbnail" alt="Profile Picture">
                  @endif
                </li>

                <li class="mt-4 mb-2">
                  <h6 class="text-muted">Contact Details</h6>
                  <hr class="mt-0" />
                </li>
                <li>
                  <span class="text-muted">Email Address: </span>
                  @if($connection['connected'])
                  {{ $tutor->user_email }}
                  @else
                  <span class="text-warning">********@******.com</span>
                  @endif
                </li>

                @if($tutor->user_mobile != "")
                <li>
                  <span class="text-muted">Mobile: </span>
                  @if($connection['connected'])
                  +880{{ $tutor->user_mobile }}
                  @else
                  <span class="text-warning">+880 **** ******</span>
                  @endif

                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>

        <div class="card-footer text-center pt-4 pb-4">
          @if(auth()->user()->type == 1)
          @if($tutor->reviewed == 0)
          @include('tutors.modals.approve')
          @include('tutors.modals.disapprove')
          @else
          @if($tutor->approved_at == "")
          @include('tutors.modals.approve')
          <!-- disapproved profile -->
          <button type="button" class="btn btn-sm btn-danger ml-2">Disapproved profile</button>
          @else
          <!-- approved profile -->
          <button type="button" class="btn btn-sm btn-success mr-2">Approved profile</button>
          @include('tutors.modals.disapprove')
          @endif
          @endif
          @elseif(auth()->user()->type == 3)

          @if($connection['connected'])
          @include('tutors.modals.disconnect')
          @include('tutors.modals.block')
          @elseif($connection['request'] == 'received')
          @include('tutors.modals.accept')
          @include('tutors.modals.reject')
          @endif

          @endif
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection
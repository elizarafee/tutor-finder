@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-header text-center">
          <h5 class="card-title">{{$student->user_first_name}} {{$student->user_last_name}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">We assume you looking for tutor</h6>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 col-md-3 text-center text-info">

            @if($student->picture == '')
              <i class="far fa-id-badge fa-9x text-light"></i>
              @else
              <img src="{{ asset($user->picture) }}" class="img-thumbnail" alt="Profile Picture">
              @endif

            </div>
            <div class="col-sm-6 col-md-9">
              <ul class="list-unstyled float-left">
                <li><span class="text-muted">Location: </span>{{ $student->location }}</li>
                <li><span class="text-muted">Budget: </span>&#2547;{{ $student->budget }}</li>
                <li class="mt-4 mb-2">
                  <h6 class=" text-muted">Proof of Identification</h6>
                  <hr class="mt-0" />

                  @if($student->proof_of_id == '')
                  <i class="far fa-address-card fa-9x text-light"></i>
                  @else
                  <img src="{{ asset($student->proof_of_id) }}" class="img-thumbnail" alt="Profile Picture">
                  @endif

                </li>
                <li class="mt-4">
                  <h6 class="text-muted">Student Details</h6>
                  <hr class="mt-0" />
                </li>
                <li><span class="text-muted">Bio: </span>{{ $student->bio }}</li>
                <li><span class="text-muted">Age: </span>{{ date('Y') - $student->doy }}</li>
                <li><span class="text-muted">Gender: </span>{{ $student->gender }}</li>
                <li><span class="text-muted">Class: </span>{{ years_of_study($student->class) }}</li>
                <li><span class="text-muted">Institute: </span>{{ $student->institute }}</li>
                <li><span class="text-muted">Subjects need tution: </span>{{ $student->subjects }}</li>
                @if($student->requirements != '')
                <li><span class="text-muted">Any other requirements: </span> {{ $student->requirements }}</li>
                @endif
                <li class="mt-4 mb-2">
                  <h6 class="text-muted">Contact Details</h6>
                  <hr class="mt-0" />
                </li>
                <li><span class="text-muted">Email Address: </span>{{ $student->user_email }}</li>
                
                @if($student->user_mobile != "") 
                <li><span class="text-muted">Mobile: </span> +880{{ $student->user_mobile }}</li>
                @endif 
              </ul>
            </div>
          </div>
        </div>

        <div class="card-footer text-center pt-4 pb-4">

          @if(auth()->user()->type == 1)

          @if($student->approved_at == "")

          <!-- approve profile modal -->
          <button type="button" class="btn btn-sm btn-outline-success mr-2" data-toggle="modal" data-target="#approve-profile-modal">
            Approve the profile
          </button>
          <div class="modal fade" id="approve-profile-modal" tabindex="-1" role="dialog" aria-labelledby="approve-profile-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <form method="POST" action="{{ url('/profiles/'.$student->user_id.'/approve') }}">
                  @csrf
                  @method('PUT')

                  <div class="modal-header">
                    <h5 class="modal-title" id="approve-profile-modalLabel">Profile approve</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="text-left">
                      Are you sure to approve profile of {{ $student->user_first_name.' '.$student->user_last_name}}?
                      <span class="badge badge-info">Please verify proof of identification before approve the profile</span>
                    </p>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                  </div>
              </div>
              </form>
            </div>
          </div>

          <!-- disapprove profile modal -->
          <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#disapprove-profile-modal">
            Disapprove the profile
          </button>
          <div class="modal fade" id="disapprove-profile-modal" tabindex="-1" role="dialog" aria-labelledby="disapprove-profile-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <form method="POST" action="{{ url('/profiles/'.$student->user_id.'/disapprove') }}">
                  @csrf
                  @method('PUT')

                  <div class="modal-header">
                    <h5 class="modal-title" id="disapprove-profile-modalLabel">Profile disapprove</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-row">
                      <label>Please provide reason</label>
                      <textarea name="reason" class="form-control" placeholder="Why you are disapproving this profile?"></textarea>
                    </div>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-sm btn-danger">Disapprove</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          @else

          <!-- approved profile -->
          <button type="button" class="btn btn-sm btn-success mr-2">Approved profile</button>

          <!-- disapprove profile modal -->
          <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#disapprove-profile-modal">
            Disapprove the profile
          </button>
          <div class="modal fade" id="disapprove-profile-modal" tabindex="-1" role="dialog" aria-labelledby="disapprove-profile-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <form method="POST" action="{{ url('/profiles/'.$student->user_id.'/disapprove') }}">
                  @csrf
                  @method('PUT')

                  <div class="modal-header">
                    <h5 class="modal-title" id="disapprove-profile-modalLabel">Profile disapprove</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-row">
                      <label>Please provide reason</label>
                      <textarea name="reason" class="form-control" placeholder="Why you are disapproving this profile?"></textarea>
                    </div>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-sm btn-danger">Disapprove</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            @endif



            @elseif(auth()->user()->type == 2)

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-outline-primary mr-2" data-toggle="modal" data-target="#disapprove-profile-modal">
              Remove connection
            </button>

            <!-- Modal -->
            <div class="modal fade" id="disapprove-profile-modal" tabindex="-1" role="dialog" aria-labelledby="disapprove-profile-modalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="disapprove-profile-modalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#exampleModal">
              Block this profile
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>

            @endif

          </div>
        </div>
        
      </div>
    </div>
  </div>



  @endsection
@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      @if($user->approved_at == '')
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        This profile is not yet approved.
      </div>
      @endif

      <div class="card">
        <div class="card-header text-center">
          <h5 class="card-title">{{$user->first_name}} {{$user->last_name}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">Student Guardian / Student</h6>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 col-md-4 text-center text-info">

              @if($user->picture == '')
              <i class="far fa-id-badge fa-9x text-light"></i>
              @else
              <img src="{{ asset($user->picture) }}" class="img-thumbnail" alt="Profile Picture">
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
                  <img src="{{ asset($user->proof_of_id) }}" class="img-thumbnail" alt="Profile Picture">
                  @endif
                </li>

                <li class="mt-4">
                  <h6 class="mt-4">Student Details</h6>
                  <hr class="mt-0" />
                </li>

                <li><span class="text-muted">Bio: </span>{{ $student->bio }}</li>
                <li><span class="text-muted">Age: </span>{{ date('Y') - $student->doy }}</li>
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

          <!-- deactive profile modal -->
          <button type="button" class="btn btn-sm btn-outline-secondary mr-2" data-toggle="modal" data-target="#deactive-profile-modal">
            Deactive profile
          </button>
          <div class="modal fade" id="deactive-profile-modal" tabindex="-1" role="dialog" aria-labelledby="deactive-profile-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <form method="POST" action="{{ url('/profile/'.auth()->user()->id.'/deactive') }}">
                  @csrf
                  @method('PUT')

                  <div class="modal-header">
                    <h5 class="modal-title" id="deactive-profile-modalLabel">Deactive profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="text-left">
                      Are you sure to deactive your profile?
                    </p>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success">Yes</button>
                  </div>
              </div>
              </form>
            </div>
          </div>

          @else

          <!-- activate profile modal -->
          <button type="button" class="btn btn-sm btn-outline-success mr-2" data-toggle="modal" data-target="#activate-profile-modal">
            Activate profile
          </button>
          <div class="modal fade" id="activate-profile-modal" tabindex="-1" role="dialog" aria-labelledby="activate-profile-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <form method="POST" action="{{ url('/profile/'.$student->user_id.'/activate') }}">
                  @csrf
                  @method('PUT')

                  <div class="modal-header">
                    <h5 class="modal-title" id="activate-profile-modalLabel">Activate profile </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="text-left">
                      Are you sure to activate your profile?
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success">Activate</button>
                  </div>
              </div>
              </form>
            </div>
          </div>

          <!-- delete profile modal -->
          <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete-profile-modal">
            Delete profile
          </button>
          <div class="modal fade" id="delete-profile-modal" tabindex="-1" role="dialog" aria-labelledby="delete-profile-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <form method="POST" action="{{ url('/profile/'.$student->user_id) }}">
                  @csrf
                  @method('DELETE')

                  <div class="modal-header">
                    <h5 class="modal-title" id="delete-profile-modalLabel">Delete profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="text-left">
                      Are you sure to delete your profile?
                      It will delete profile and all the it's realated information.
                    </p>
                    <p class="text-left text-info">Rether deative your profile. It will hide your profile from students.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                  </div>
              </div>
              </form>
            </div>
          </div>

          @endif

        </div>
      </div>
    </div>
  </div>
</div>



@endsection
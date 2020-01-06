@extends('layouts.app')

@section('content')
<div class="container">

    {{$tutors->links()}}

    @foreach($tutors as $tutor)

    <div class="row mb-3 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                <?php $connection = has_connection($tutor->user_id); ?>
                    <div class="row">
                        <div class="col-sm-6 col-md-3 text-center text-info">
                        @if($tutor->picture == '')
              <i class="far fa-id-badge fa-9x text-light"></i>
              @else
              <a href="{{url('/tutors/'.$tutor->id)}}">
                <img src="{{ asset('storage/'.$user->picture) }}" class="img-thumbnail" alt="Profile Picture">
              </a>
              @endif

              @if($connection && $connection->approved_at != "") <span class="badge badge-success mt-3">Connected</span> @endif
            

                        </div>
                        <div class="col-sm-6 col-md-9">

                            <ul class="list-unstyled float-left">
                                <li><span class="text-muted">Bio: </span>{{$tutor->bio}}</li>
                                <li><span class="text-muted">Subjects covered: </span>{{$tutor->covered_subjects}}</li>
                                <li><span class="text-muted">Area covered: </span>{{$tutor->locations}}</li>
                                <li><span class="text-muted">Min expected salary: </span>&#2547;{{$tutor->salary}} <small>(per subject per month)</small></li>
                                <li><span class="text-muted">Qualification: </span>{{$tutor->status}} in {{$tutor->subject}} at {{$tutor->institute}}</span></li>

                                @if(auth()->user()->type == 1)
                <li class="mt-2">
                  <a href="{{ url('/tutors/'.$tutor->id) }}" class="btn btn-sm btn-outline-success">View details</a>
                </li>
                @elseif(auth()->user()->type == 3)

                <li class="mt-2">

                  @if($connection)

                  @if($connection->approved_at == "")
                  <span class="badge badge-secondary">Request sent at {{date('j F Y g:iA', strtotime($connection->created_at))}}</span>
                  <br />
                  <!-- connection request modal -->
                  <button type="button" class="btn btn-sm btn-outline-danger mt-1" data-toggle="modal" data-target="#cancel-{{$tutor->id}}-request-modal">
                    Cancel request
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="cancel-{{$tutor->id}}-request-modal" tabindex="-1" role="dialog" aria-labelledby="cancel-request-modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <form method="POST" action="{{ url('/connections/'.$tutor->user_id) }}">
                          @csrf
                          @method('DELETE')
                          <div class="modal-header">
                            <h5 class="modal-title" id="cancel-request-modalLabel">Cancel request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure to send cancel the connection request?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-danger">Yes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  @else
                  <a href="{{ url('/tutors/'.$tutor->id) }}" class="btn btn-sm btn-outline-success">View details</a>

                  @endif
                  @else

                  <!-- connection request modal -->
                  <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#connection-{{$tutor->id}}-request-modal">
                    Request to connect
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="connection-{{$tutor->id}}-request-modal" tabindex="-1" role="dialog" aria-labelledby="connection-request-modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <form method="POST" action="{{ url('/connections/'.$tutor->user_id) }}">
                          @csrf
                          <div class="modal-header">
                            <h5 class="modal-title" id="connection-request-modalLabel">Request to connect</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure to send request to connect?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Send</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  @endif

                </li>
                @endif
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
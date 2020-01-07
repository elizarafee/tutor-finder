@extends('layouts.app')

@section('page_title', 'Tutors')

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
              <a href="{{url('/tutors/'.$tutor->id)}}" class="d-block mb-3">
                @if($tutor->picture == '')
                <i class="far fa-id-badge fa-6x text-light"></i>
                @else
                <img src="{{ asset('storage/'.$user->picture) }}" class="img-thumbnail" alt="Profile Picture">
                @endif
              </a>

              @if(auth()->user()->type == 1)
              <a href="{{ url('/tutors/'.$tutor->id) }}" class="btn btn-sm btn-outline-success">View details</a>
              @elseif(auth()->user()->type == 3)



              @if($connection)
                @if($connection->approved_at == "")

                <!-- connection request modal -->
                <button type="button" title="Sent at {{ date('j F Y g:iA', strtotime($connection->created_at)) }}"
                  class="btn btn-sm btn-outline-danger" data-toggle="modal"
                  data-target="#cancel-{{$tutor->id}}-request-modal">
                  Cancel request
                </button>

                <!-- Modal -->
                <div class="modal fade" id="cancel-{{$tutor->id}}-request-modal" tabindex="-1" role="dialog"
                  aria-labelledby="cancel-request-modalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                  data-target="#connection-{{$tutor->id}}-request-modal">
                  Request to connect
                </button>

                <!-- Modal -->
                <div class="modal fade" id="connection-{{$tutor->id}}-request-modal" tabindex="-1" role="dialog"
                  aria-labelledby="connection-request-modalLabel" aria-hidden="true">
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
              @endif
            </div>
            <div class="col-sm-6 col-md-9">
              <ul class="list-unstyled float-left">
                @if(auth()->user()->type == 1)
                <li><a href="{{url('/tutors/'.$tutor->id)}}">{{$tutor->first_name.' '.$tutor->last_name}}</a></li>
                @endif 
                <li><span class="text-muted">Bio <small>({{date('Y') - $tutor->doy}} year old
                      {{$tutor->gender}})</small> : </span>{{substr($tutor->bio, 0, 120)}} @if(strlen($tutor->bio)>120)
                  ... @endif</li>
                <li><span class="text-muted">Subjects covered: </span>{{$tutor->covered_subjects}}</li>
                <li><span class="text-muted">Area covered: </span>{{$tutor->locations}}</li>
                <li><span class="text-muted">Expected salary: </span>&#2547;{{$tutor->salary}} <small>(per subject per
                    month)</small></li>
                <li><span class="text-muted">Qualification: </span>
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
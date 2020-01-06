@extends('layouts.app')

@section('content')
<div class="container">

  {{$students->links()}}

  @foreach($students as $student)

  <div class="row mb-3 justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <?php $connection = has_connection($student->user_id); ?>
          <div class="row">
            <div class="col-sm-6 col-md-3 text-center text-info">
              @if($student->picture == '')
              <i class="far fa-id-badge fa-9x text-light"></i>
              @else
              <a href="{{url('/students/'.$student->id)}}">
                <img src="{{ asset('storage/'.$user->picture) }}" class="img-thumbnail" alt="Profile Picture">
              </a>
              @endif

              @if($connection && $connection->approved_at != "") <span class="badge badge-success mt-3">Connected</span> @endif
            </div>
            <div class="col-sm-6 col-md-9">

              <ul class="list-unstyled float-left">
                <li class="text-muted"><span class="text-dark">Location: </span>{{ $student->location }}</li>
                <li class="text-muted"><span class="text-dark">Budget: </span>&#2547;{{ $student->budget }} <small>(per subject per month)</small></li>
                <li class="text-muted"><span class="text-dark">Student bio: </span>{{substr($student->bio, 0, 120)}} @if(strlen($student->bio)>120) ... @endif</li>
                <li class="text-muted"><span class="text-dark">Student gender: </span>{{$student->gender}}</li>
                <li class="text-muted"><span class="text-dark">Student age: </span>{{date('Y') - $student->doy}}</li>
                <li class="text-muted"><span class="text-dark">Tution needed for: </span> {{$student->subjects}}</li>
                <li class="text-muted"><span class="text-dark">Student status : </span> Studying in {{ years_of_study($student->class) }} at {{ $student->institute }}</li>

                @if(auth()->user()->type == 1)
                <li class="mt-2">
                  <a href="{{ url('/students/'.$student->id) }}" class="btn btn-sm btn-outline-success">View details</a>
                </li>
                @elseif(auth()->user()->type == 2)

                <li class="mt-2">

                  @if($connection)

                  @if($connection->approved_at == "")
                  <span class="badge badge-secondary">Request sent at {{date('j F Y g:iA', strtotime($connection->created_at))}}</span>
                  <br />
                  <!-- connection request modal -->
                  <button type="button" class="btn btn-sm btn-outline-danger mt-1" data-toggle="modal" data-target="#cancel-{{$student->id}}-request-modal">
                    Cancel request
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="cancel-{{$student->id}}-request-modal" tabindex="-1" role="dialog" aria-labelledby="cancel-request-modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <form method="POST" action="{{ url('/connections/'.$student->user_id) }}">
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
                  <a href="{{ url('/students/'.$student->id) }}" class="btn btn-sm btn-outline-success">View details</a>

                  @endif
                  @else

                  <!-- connection request modal -->
                  <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#connection-{{$student->id}}-request-modal">
                    Request to connect
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="connection-{{$student->id}}-request-modal" tabindex="-1" role="dialog" aria-labelledby="connection-request-modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <form method="POST" action="{{ url('/connections/'.$student->user_id) }}">
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

  {{$students->links()}}
</div>


@endsection
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
                <div class="card-header">
                    <h5 class="card-title">{{$user->first_name}} {{$user->last_name}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">We assume you looking for tutor</h6>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6 col-md-4 text-center text-info">
                            <img src="{{ asset('storage/'.$user->picture) }}" class="w-100 img-thumbnail" alt="...">
                        </div>
                        <div class="col-sm-6 col-md-8">

                            <ul class="list-unstyled float-left">
                                <li><span class="text-muted">Location: </span>{{ get_locations($student->location) }}</li>
                                <li><span class="text-muted">Budget: </span>&#2547;{{ $student->budget }}</li>

                                <li class="mt-4 mb-2">
                                    <h6 class=" text-muted">Proof of Identification</h6>
                                    <hr class="mt-0" />
                                    <img src="{{ asset('storage/'.$user->proof_of_id) }}" class="img-fluid border border-secondary rounded p-1" style="max-height: 150px;" alt="Proof of Identification">
                                </li>

                                <li class="mt-4">
                                    <h6 class="mt-4">Student Details</h6>
                                    <hr class="mt-0" />
                                </li>

                                <li><span class="text-muted">Bio: </span>{{ $student->bio }}</li>
                                <li><span class="text-muted">Age: </span>{{ $student->doy }}</li>
                                <li><span class="text-muted">Gender: </span>{{ $student->gender }}</li>
                                <li><span class="text-muted">Class: </span>{{ $student->class }}</li>
                                <li><span class="text-muted">Institute: </span>{{ $student->institute }}</li>
                                <li><span class="text-muted">Subjects need tutions: </span>{{ $student->subjects }}</li>
                                
                                @if($student->requirements != '')
                                    <li><span class="text-muted">Any other requirements: </span> {{ $student->requirements }}</li>
                                @endif 

                                
                                <li class="mt-3">
                                    <hr/>

                                    @if($user->type == 1) 

                                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
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




                                    @elseif($user->type == 2) 

                                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Remove connection 
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

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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



                                    @elseif($user->type == 3) 

                                    <!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#deactivate-account-modal">
  Deactive account
</button>

<!-- Modal -->
<div class="modal fade" id="deactivate-account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete-account-modal">
  Delete account
</button>

<!-- Modal -->
<div class="modal fade" id="delete-account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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



                                </li>
                            </ul>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@extends('layouts.app')

@section('content')
<div class="container">

  {{$students->links()}}

  @foreach($students as $student)

  <div class="row mb-3 justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 col-md-3 text-center text-info">
              <!-- <i class="far fa-id-badge fa-9x"></i> -->
              <a href="{{url('/students/'.$student->id)}}">
                <img src="{{ asset('storage/'.$student->picture) }}" class="w-100 img-thumbnail" alt="...">
              </a>
            </div>
            <div class="col-sm-6 col-md-9">

              <ul class="list-unstyled float-left">
                <li class="text-muted"><span class="text-dark">Location: </span>{{ get_locations($student->location) }}</li>
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
                  <span class="badge badge-warning">Connection request sent at "date"</span>
                  <span class="badge badge-success">Connected</span>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
                    Request to connect
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
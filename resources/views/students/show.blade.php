@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header text-center">
          <h5 class="card-title">{{$student->first_name}} {{$student->last_name}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">Guardian</h6>
        </div>
        <div class="card-body">
        @include('students.alert')
          <div class="row">
            <div class="col-sm-6 col-md-3 text-center text-info">
              @include('students.docs.picture')
            </div>
            <div class="col-sm-6 col-md-9">
              <ul class="list-unstyled float-left">
                <li><span class="text-muted">Location: </span>{{ $student->location }}</li>
                <li><span class="text-muted">Budget: </span>&#2547;{{ $student->budget }}</li>
                <li class="mt-4 mb-2">
                  <h6 class=" text-muted">Proof of Identification</h6>
                    <hr class="mt-0" />
                    @include('students.docs.proof-of-id')
                </li>
                <li class="mt-4">
                  <h6 class="text-muted">Student Details</h6>
                  <hr class="mt-0" />
                </li>
                <li><span class="text-muted">Bio: </span>{{ $student->bio }}</li>
                <li><span class="text-muted">Age: </span>{{ date('Y') - $student->year_of_birth }}</li>
                <li><span class="text-muted">Gender: </span>{{ $student->gender }}</li>
                <li><span class="text-muted">Class: </span></li>
                <li><span class="text-muted">Institute: </span>{{ $student->institute }}</li>
                <li><span class="text-muted">Subjects need tution: </span>{{ $student->subjects }}</li>
                @if($student->requirements != '')
                <li><span class="text-muted">Any other requirements: </span> {{ $student->requirements }}</li>
                @endif
                <li class="mt-4 mb-2">
                  <h6 class="text-muted">Contact Details</h6>
                  <hr class="mt-0" />
                </li>
                <li>
                  <span class="text-muted">Email Address: </span>
                  @if($connection['connected'])
                  {{ $student->email }}
                  @else
                  <span class="text-primary">********@******.com</span>
                  @endif
                </li>

                @if($student->mobile != "")
                <li>
                  <span class="text-muted">Mobile: </span>
                  @if($connection['connected'])
                  +880{{ $student->mobile }}
                  @else
                  <span class="text-primary">+880 **** ******</span>
                  @endif
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>

        <div class="card-footer text-center pt-4 pb-4">
          @if(auth()->user()->type == 1)

            @if($student->reviewed == 0)

              @include('students.modals.approve')
              @include('students.modals.disapprove')

            @else

              @if($student->approved_at == "")
                @include('students.modals.approve')
                <!-- disapproved profile -->
                <button type="button" class="btn btn-sm btn-danger ml-2">Disapproved profile</button>
              @else
                <!-- approved profile -->
                <button type="button" class="btn btn-sm btn-success mr-2">Approved profile</button>
                @include('students.modals.disapprove')
              @endif

            @endif

          @elseif(auth()->user()->type == 2)

            @if($connection['connected'])
              @include('students.modals.disconnect')
            @elseif($connection['request'] == 'received')
              @include('students.modals.accept')
              @include('students.modals.reject')
            @endif

          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
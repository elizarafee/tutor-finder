@extends('layouts.app')

@section('page_title', 'Profiles')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if($tutors->count()) 
                    <table class="table table-sm table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{ $tutors->count() }} tutors awaiting for approval</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tutors as $tutor)
                            <tr>
                                <td>
                                    <a href="{{ url('/tutors/'.$tutor->id) }}">{{$tutor->first_name.' '.$tutor->last_name}}</a> 
                                    <small class="text-muted">requested at {{date('j M Y g:i a', strtotime($tutor->completed_at))}}</small>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else 
                    <div class="alert alert-success" role="alert">
                        No tutor awaiting for approval.
                    </div>
                    @endif 
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                @if($students->count()) 
                    <table class="table table-sm table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{ $students->count() }} guardians awaiting for approval</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>
                                    <a href="{{ url('/students/'.$student->id) }}">{{$student->first_name.' '.$student->last_name}}</a> 
                                    <small class="text-muted">requested at {{date('j M Y g:i a', strtotime($student->completed_at))}}</small>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else 
                    <div class="alert alert-success" role="alert">
                        No tutor awaiting for approval.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
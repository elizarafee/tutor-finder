@extends('layouts.app')

@section('page_title', 'Connection Requests')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if($requests->count() > 0)
                    <table class="table table-sm table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">You have {{ $requests->count() }} new connection request</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                            <tr>
                                <td>
                                    <a href="{{ url('/tutors/'.$request->tutor_id) }}">{{$request->first_name.'
                                        '.$request->last_name}}</a>
                                    <small class="text-muted">requested to connect at {{date('j M Y g:i a',
                                        strtotime($request->created_at))}}</small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else

                    <div class="alert alert-success text-center" role="alert">
                        <p>You have no pending connection request.</p>
                    </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
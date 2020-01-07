@extends('layouts.app')

@section('page_title', 'Connections')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if($requests->count() > 0)
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

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
                                    <a href="{{ url('/tutors/'.$request->id) }}">{{$request->first_name.' '.$request->last_name}}</a> 
                                    <small class="text-muted">requested at {{date('j M Y g:i a', strtotime($request->created_at))}}</small>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>


                   
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection 
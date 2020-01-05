@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3 text-center text-info">
                        <i class="far fa-id-badge fa-9x"></i>
                    </div>
                    <div class="col-sm-6 col-md-9">
                    <h5 class="card-title">Administrator</h5>
                    <hr/>

                        <ul class="list-unstyled float-left">
                            <li><span class="text-muted">Name: </span>{{$user->first_name}} {{$user->last_name}}</li>
                            <li><span class="text-muted">Email Address: </span>{{$user->email}}</li>
                    
                       
                        </ul>



                   </div>
                </div>



            </div>
        </div>
    </div>
</div>
</div>



@endsection
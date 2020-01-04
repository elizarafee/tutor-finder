@extends('layouts.app')

@section('content')


    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">


                <h5 class="card-title">{{$user->first_name}} {{$user->last_name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$tutor->bio}}</h6>




                </div>

                <div class="card-body">



                <pre>
    <?php // print_r($user); ?>
</pre>
                   
                </div>
            </div>
        </div>
    </div>



@endsection 
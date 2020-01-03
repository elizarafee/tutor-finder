@extends('layouts.app')

@section('content')


    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                <pre>
    <?php print_r($user); ?>
</pre>
                   
                </div>
            </div>
        </div>
    </div>



@endsection 
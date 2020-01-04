@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form method="POST" action="{{ route('register') }}">
                    @csrf


                    <div class="card-header">

                        <h5 class="card-title text-center">Registration</h5>
                        <h6 class="card-subtitle mb-2 text-muted text-center">Please register</h6>




                    </div>

                    <div class="card-body">




                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                <small class="form-text text-info">We will send account verification email and all notification to this email, and you will not be able to update this email without verification.</small>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4 border border-info rounded bg-light p-3">

                                <div class="form-check @error('type') is-invalid @enderror mb-1">
                                    <input class="form-check-input" type="radio" name="type" id="type1" value="2" @if(old('type') == 2) checked @endif>
                                    <label class="form-check-label" for="type1">
                                        I am registering as a Tutor
                                    </label>
                                </div>
                                <div class="form-check @error('type') is-invalid @enderror">
                                    <input class="form-check-input" type="radio" name="type" id="type2" value="3" @if(old('type') == 3) checked @endif>
                                    <label class="form-check-label" for="type2">
                                    I am registering to find a Tutor
                                    </label>
                                </div>


                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Please let us know why you are registering</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-outline-secondary pl-5 pr-5">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
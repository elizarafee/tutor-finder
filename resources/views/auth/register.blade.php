@extends('layouts.app')

@section('page_title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="card">
                    <div class="card-body pt-5">
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="email">
                                <small class="form-text text-info">We will send account verification email and all
                                    notification to this email, and you will not be able to update this email without
                                    verification.</small>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password
                                <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Registering as
                                <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div
                                    class="custom-control @error('type') is-invalid @enderror custom-radio custom-control-inline">
                                    <input type="radio" name="type" value="2" id="customRadioInline1"
                                        name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline1">Tutor</label>
                                </div>
                                <div
                                    class="custom-control @error('type') is-invalid @enderror custom-radio custom-control-inline">
                                    <input type="radio" name="type" value="3" id="customRadioInline2"
                                        name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline2">Guardian</label>
                                </div>

                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Please let us know who you are.</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Consent <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6 ">
                                <div class="form-check @error('consent') is-invalid @enderror">
                            <input type="checkbox" class="form-check-input" id="consent" name="consent">
                                <label class="form-check-label" for="consent"> By registering here I have consent with Tutor Finder's Terms of User and Privacy & Cookie Policy</label>
                                </div>
                                

                                @error('consent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-outline-secondary pl-5 pr-5">
                        Register
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
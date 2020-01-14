@extends('layouts.app')

@section('page_title', 'Contact')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p class="text-center">Please tell us if you have any issue.</p>
            <form method="POST" action="{{ url('contact') }}">
                @csrf
                <div class="card">
                    <div class="card-body pt-5">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    @if(Auth::check())  value="{{ auth()->user()->first_name.' '.auth()->user()->last_name }}" readonly="true" @else value="{{ old('name') }}" @endif autofocus>

                                @error('name')
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
                                    name="email" @if(Auth::check()) value="{{ auth()->user()->email }}" readonly="true" @else value="{{ old('email') }}" @endif>
                                
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right">Message <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <textarea id="message" rows="5" class="form-control @error('message') is-invalid @enderror" name="message">{{ old('message') }}</textarea>
                                
                                @error('message')
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
                       Send Message
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
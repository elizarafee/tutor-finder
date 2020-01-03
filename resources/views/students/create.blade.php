@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card-header">
                        <h5 class="card-title text-center">Register to find a Tutor</h5>
                        <h6 class="card-subtitle mb-2 text-muted text-center">Registration</h6>
                    </div>

                    <div class="card-body">

                        <h5 class="card-title">Product</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <label for="first_name" class="col-md-8 col-form-label">{{ Auth::user()->first_name }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <label for="first_name" class="col-md-8 col-form-label">{{ Auth::user()->email }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

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







                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <div class="col-md-6">
             
                <input type="file" name="image" class="btn btn-sm btn-outline-secondary @error('image') is-invalid @enderror" id="customFileLangHTML">
                
                @error('image')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror

 
            </div>
                        </div>


                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <div class="col-md-6">
              <div class="custom-file" id="fileupload">
                <input id="browse" type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="customFileLangHTML">
                <label class="custom-file-label" for="customFileLangHTML" data-browse="Image">Please select an image</label>

                @error('image')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror

              </div>
            </div>
                        </div>


                        

         

                        <h5 class="card-title">Product</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

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
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

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
                            <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>

                            <div class="col-md-6">
                                <select class="custom-select @error('type') is-invalid @enderror" name="type">
                                    <option value=""> -- Please select -- </option>
                                </select>

                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
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
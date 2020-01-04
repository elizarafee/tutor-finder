@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form method="POST" action="{{ url('/tutors') }}">
                    @csrf
      
                    <div class="card-header">
                        <h5 class="card-title text-center">Register as a Tutor</h5>
                        <h6 class="card-subtitle mb-2 text-muted text-center">Registration</h6>
                    </div>

                    <div class="card-body">

                        <h5 class="card-title">Product</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <label for="first_name" class="col-md-8 col-form-label">{{ auth()->user()->first_name.' '.auth()->user()->last_name }}</label>
                        </div>

                        



                        <div class="form-group row">

                            <label for="picture" class="col-md-4 col-form-label text-md-right">Profile Picture</label>
                            <div class="col-md-6">
                                <input type="file" name="picture" class="btn btn-sm btn-outline-secondary @error('picture') is-invalid @enderror" id="customFileLangHTML">

                                @error('picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="proof_of_id" class="col-md-4 col-form-label text-md-right">Proof of Identification</label>
                            <div class="col-md-6">
                                <input type="file" name="proof_of_id" class="btn btn-sm btn-outline-secondary @error('proof_of_id') is-invalid @enderror" id="customFileLangHTML">

                                @error('proof_of_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">Bio</label>

                            <div class="col-md-6">
                                <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio">{{ old('bio') }}</textarea>

                                @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subjects" class="col-md-4 col-form-label text-md-right">Subjects</label>

                            <div class="col-md-6">
                                <textarea id="subjects" class="form-control @error('subjects') is-invalid @enderror" name="subjects">{{ old('subjects') }}</textarea>

                                @error('subjects')
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

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Mobile</label>

                            <div class="col-md-6">
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping">+880</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Mobile" aria-label="Username" aria-describedby="addon-wrapping">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h5 class="card-title">Contacts</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Please provide contact detials</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <label for="first_name" class="col-md-8 col-form-label">{{ auth()->user()->email }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Mobile</label>

                            <div class="col-md-6">
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping">+880</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Mobile" aria-label="Username" aria-describedby="addon-wrapping">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <h5 class="card-title">Qualification</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Please provide most recent qualification</h6>
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
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
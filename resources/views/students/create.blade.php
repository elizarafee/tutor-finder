@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form method="POST" action="{{ url('/students') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-header">
                        <h5 class="card-title text-center">Your Profile</h5>
                        <h6 class="card-subtitle mb-2 text-muted text-center">Please complete your profile</h6>
                    </div>

                    <div class="card-body">

                        <h5 class="card-title">Personal Details</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Please provide personal details</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <label class="col-md-8 col-form-label">{{ auth()->user()->first_name.' '.auth()->user()->last_name }}</label>
                        </div>


                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right">Profile Picture</label>
                            <div class="col-md-6">
                                <input type="file" name="picture" class="btn btn-sm btn-outline-secondary @error('picture') is-invalid @enderror">
                                <small class="form-text text-info"></small>

                                @error('picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="proof_of_id" class="col-md-4 col-form-label text-md-right">Proof of Identification <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="file" name="proof_of_id" class="btn btn-sm btn-outline-secondary @error('proof_of_id') is-invalid @enderror">
                                <small class="form-text text-danger"><span class="text-info">i.e. NID card, Passport, Driving Licence, Student ID card.</span> Your profile will not be approved without a valid Proof of identification.</small>

                                @error('proof_of_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">Location <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select class="custom-select @error('location') is-invalid @enderror" name="location">
                                    <option value="" selected> -- Please select -- </option>
                                    @foreach(locations() as $location)
                                    <option value="{{$location['name']}}" @if(old('location') == $location['name']) selected @endif> {{ $location['name'] }} </option>
                                    @endforeach
                                </select>

                                @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="budget" class="col-md-4 col-form-label text-md-right">Estimated Budget <span class="text-danger">*</span><br /><small class="text-info">(per subject)</small></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputbudgetPrepend">&#2547;</span>
                                    </div>
                                    <input type="text" name="budget" class="form-control @error('budget') is-invalid @enderror" aria-describedby="inputbudgetPrepend" value="{{ old('budget') }}">
                                    <small class="form-text text-info">This should be your minimum expected budget per month</small>

                                    @error('budget')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <h5 class="card-title">Contacts</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Please provide contact detials</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <label class="col-md-8 col-form-label">{{ auth()->user()->email }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputMobilePrepend">+880</span>
                                    </div>
                                    <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" aria-describedby="inputMobilePrepend" value="{{ old('mobile') }}">

                                    @error('mobile')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <small class="form-text text-info">Please provide the mobile no. you want receive calls from guardians</small>
                            </div>
                        </div>


                        <h5 class="card-title">Student Details</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Please provide details</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">Bio <span class="text-danger">*</span></label>
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
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Gender <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select class="custom-select @error('gender') is-invalid @enderror" name="gender">
                                    <option value=""> -- Please select -- </option>
                                    <option value="Male" @if(old('gender')=='Male' ) selected @endif> Male </option>
                                    <option value="Female" @if(old('gender')=='Female' ) selected @endif> Female </option>
                                </select>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year_of_birth" class="col-md-4 col-form-label text-md-right">Year of Birth <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="year_of_birth" type="text" class="form-control @error('year_of_birth') is-invalid @enderror" name="year_of_birth" value="{{ old('year_of_birth') }}">

                                @error('year_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">Class <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select class="custom-select @error('class') is-invalid @enderror" name="class">
                                    <option value=""> -- Please select -- </option>
                                    @foreach(years_of_study() as $key => $year)
                                    <option value="{{$key}}" @if(old('class')==$key) selected @endif> {{ $year }} </option>
                                    @endforeach
                                </select>

                                @error('class')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="institute" class="col-md-4 col-form-label text-md-right">Institute <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="institute" type="text" class="form-control @error('institute') is-invalid @enderror" name="institute" value="{{ old('institute') }}">

                                @error('institute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="subjects" class="col-md-4 col-form-label text-md-right">Subjects <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea id="subjects" class="form-control @error('subjects') is-invalid @enderror" name="subjects">{{ old('subjects') }}</textarea>
                                <small class="form-text text-info">Please type subjects you want to take tution</small>

                                @error('subjects')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="requirements" class="col-md-4 col-form-label text-md-right">Requirements</label>
                            <div class="col-md-6">
                                <textarea id="requirements" class="form-control @error('requirements') is-invalid @enderror" name="requirements">{{ old('requirements') }}</textarea>
                                <small class="form-text text-info">Please provide if you need any other specific requirements</small>

                                @error('requirements')
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
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form method="POST" action="{{ url('/students') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-header">
                        <h5 class="card-title text-center">Update Profile</h5>
                        <h6 class="card-subtitle mb-2 text-muted text-center">Please complete your profile</h6>
                    </div>

                    <div class="card-body">

                        <h5 class="card-title">Personal Details</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Please provide personal details</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    @if(old('first_name')) value="{{ old('first_name') }}" @elseif(isset($student->first_name)) value="{{ $student->first_name }}" @endif>

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
                                    @if(old('last_name')) value="{{ old('last_name') }}" @elseif(isset($student->last_name)) value="{{ $student->last_name }}" @endif>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right">Profile Picture</label>
                            <div class="col-md-6">
                                @if($student->picture != '')
                                <img src="{{ asset('storage/'.$student->picture) }}" class="img-thumbnail mb-3"
                                    alt="Profile Picture">
                                @endif

                                <input type="file" name="picture"
                                    class="btn btn-sm btn-outline-secondary @error('picture') is-invalid @enderror">
                                <small class="form-text text-info"></small>

                                @error('picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="proof_of_id" class="col-md-4 col-form-label text-md-right">Proof of
                                Identification <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                @if($student->proof_of_id != '')
                                <img src="{{ asset('storage/'.$student->proof_of_id) }}" class="img-thumbnail mb-3"
                                    alt="Profile Proof of Identification">
                                @endif

                                <input type="file" name="proof_of_id"
                                    class="btn btn-sm btn-outline-secondary @error('proof_of_id') is-invalid @enderror">
                                    <small class="form-text text-info">i.e. NID card, Passport, Driving Licence, Student ID card. Your profile will not be approved without a valid Proof of identification.</small>


                                @error('proof_of_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">Location <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select class="custom-select @error('location') is-invalid @enderror" name="location">
                                    <option value="" selected> -- Please select -- </option>
                                    @foreach(locations() as $location)
                                    <option value="{{$location['name']}}" @if(isset($student->location) && $student->location == $location['name']) selected @elseif(old('location') == $location['name'])
                                        selected @endif> {{ $location['name'] }} </option>
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
                            <label for="budget" class="col-md-4 col-form-label text-md-right">Estimated Budget <span
                                    class="text-danger">*</span><br /><small class="text-info">(per
                                    subject)</small></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputbudgetPrepend">&#2547;</span>
                                    </div>
                                    <input type="text" name="budget"
                                        class="form-control @error('budget') is-invalid @enderror"
                                        aria-describedby="inputbudgetPrepend" @if(isset($student->budget)) value="{{ $student->budget }}" @else
                                value="{{ old('budget') }}" @endif>
                                    <small class="form-text text-info">This should be your minimum expected budget per
                                        month</small>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" @if(isset($student->email)) value="{{ $student->email }}" @else value="{{ old('email') }}" @endif>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputMobilePrepend">+880</span>
                                    </div>
                                    <input type="text" name="mobile"
                                        class="form-control @error('mobile') is-invalid @enderror"
                                        aria-describedby="inputMobilePrepend" @if(old('mobile')) value="{{ old('mobile') }}" @elseif($student->mobile) value="{{ $student->mobile }}" @endif>

                                    @error('mobile')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <small class="form-text text-info">Please provide the mobile no. you want receive calls
                                    from tutors.</small>
                            </div>
                        </div>


                        <h5 class="card-title">Student Details</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Please provide details</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">Bio <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <textarea id="bio" class="form-control @error('bio') is-invalid @enderror"
                                    name="bio">@if(old('bio')){{ old('bio') }}@elseif(isset($student->bio)){{ $student->bio }}@endif</textarea>

                                @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Gender <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select class="custom-select @error('gender') is-invalid @enderror" name="gender">
                                    <option value=""> -- Please select -- </option>
                                    <option value="Male" @if(old('gender')=='Male' ) selected @elseif($student->gender == 'Male') selected @endif> Male </option>
                                    <option value="Female" @if(old('gender')=='Female' ) selected @elseif($student->gender == 'Female') selected @endif> Female
                                    </option>
                                </select>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year_of_birth" class="col-md-4 col-form-label text-md-right">Year of Birth <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="year_of_birth" type="text"
                                    class="form-control @error('year_of_birth') is-invalid @enderror"
                                    name="year_of_birth" @if(old('year_of_birth')) value="{{ old('year_of_birth') }}" @elseif($student->year_of_birth) value="{{ $student->year_of_birth }}" @endif>

                                @error('year_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">Class <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select class="custom-select @error('class') is-invalid @enderror" name="class">
                                    <option value=""> -- Please select -- </option>
                                    @foreach(years_of_study() as $key => $year)
                                    <option value="{{$key}}" @if(old('class') == $key) selected @elseif($student->class == $key) selected @endif> {{ $year }}
                                    </option>
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
                            <label for="institute" class="col-md-4 col-form-label text-md-right">Institute <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="institute" type="text"
                                    class="form-control @error('institute') is-invalid @enderror" name="institute"
                                    @if(old('institute')) value="{{ old('institute') }}" @elseif($student->institute) value="{{ $student->institute }}" @endif>

                                @error('institute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="subjects" class="col-md-4 col-form-label text-md-right">Subjects <span
                                    class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea id="subjects" class="form-control subject-tags @error('subjects') is-invalid @enderror"
                                    name="subjects">@if(old('subjects')){{ old('subjects') }}@elseif($student->subjects){{ $student->subjects }}@endif</textarea>
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
                                <textarea id="requirements"
                                    class="form-control @error('requirements') is-invalid @enderror"
                                    name="requirements">@if(old('requirements')){{ old('requirements') }}@elseif($student->requirements){{ $student->requirements }}@endif</textarea>
                                <small class="form-text text-info">Please provide if you need any other specific
                                    requirements</small>

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
                            Update and Submit Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
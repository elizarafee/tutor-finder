@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form method="POST" action="{{ url('/tutors') }}" enctype="multipart/form-data">
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
                                    @if(old('first_name')) value="{{ old('first_name') }}" @elseif(isset($tutor->user_first_name)) value="{{ $tutor->user_first_name }}" @endif>

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
                                    @if(old('last_name')) value="{{ old('last_name') }}" @elseif(isset($tutor->user_last_name)) value="{{ $tutor->user_last_name }}" @endif>

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
                                @if($tutor->user_picture != '')
                                <img src="{{ asset('storage/'.$tutor->user_picture) }}" class="img-thumbnail mb-3"
                                    alt="Profile Picture">
                                @endif

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
                            <label for="bio" class="col-md-4 col-form-label text-md-right">Bio <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio">@if(old('bio')){{ old('bio') }}@elseif(isset($tutor->bio)){{ $tutor->bio }}@endif</textarea>

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
                                    <option value="Male" @if(old('gender')=='Male' ) selected @elseif($tutor->gender == 'Male') selected @endif> Male </option>
                                    <option value="Female" @if(old('gender')=='Female' ) selected @elseif($tutor->gender == 'Female') selected @endif> Female </option>
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
                                <input id="year_of_birth" type="text" class="form-control @error('year_of_birth') is-invalid @enderror" name="year_of_birth" @if(old('year_of_birth')) value="{{ old('year_of_birth') }}" @elseif(isset($tutor->year_of_birth)) value="{{ $tutor->year_of_birth }}" @endif>

                                @error('year_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        

                        <div class="form-group row">
                            <label for="proof_of_id" class="col-md-4 col-form-label text-md-right">Proof of Identification <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                @if($tutor->user_proof_of_id != '')
                                <img src="{{ asset('storage/'.$tutor->user_proof_of_id) }}" class="img-thumbnail mb-3"
                                    alt="Profile Proof of Identification">
                                @endif

                                <input type="file" name="proof_of_id" class="btn btn-sm btn-outline-secondary @error('proof_of_id') is-invalid @enderror">
                                <small class="form-text text-info">i.e. NID card, Passport, Driving Licence, Student ID card. Your profile will not be approved without a valid Proof of identification.</small>

                                @error('proof_of_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="subjects" class="col-md-4 col-form-label text-md-right">Subjects <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea id="subjects" class="form-control @error('subjects') is-invalid @enderror" name="subjects">@if(old('subjects')){{ old('subjects') }}@elseif(isset($tutor->covered_subjects)){{ $tutor->covered_subjects }}@endif</textarea>
                                <small class="form-text text-info">Please type subjects you will want provide tution</small>

                                @error('subjects')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="locations" class="col-md-4 col-form-label text-md-right">Locations <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea id="locations" class="form-control @error('locations') is-invalid @enderror" name="locations">@if(old('locations')){{ old('locations') }}@elseif(isset($tutor->locations)){{ $tutor->locations }}@endif</textarea>
                                <small class="form-text text-info">Please provide locations you will cover for tution</small>

                                @error('locations')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="years" class="col-md-4 col-form-label text-md-right">Years <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea id="years" class="form-control @error('years') is-invalid @enderror" name="years">@if(old('years')){{ old('years') }}@elseif(isset($tutor->covered_years)){{ $tutor->covered_years }}@endif</textarea>
                                <small class="form-text text-info">Please provide years you will cover for tution</small>

                                @error('years')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salary" class="col-md-4 col-form-label text-md-right">Expected Salary <span class="text-danger">*</span><br/><small class="text-info">(per subject)</small></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputsalaryPrepend">&#2547;</span>
                                    </div>
                                    <input type="text" name="salary" class="form-control @error('salary') is-invalid @enderror" aria-describedby="inputsalaryPrepend" @if(old('salary')) value="{{ old('salary') }}" @elseif(isset($tutor->salary)) value="{{ $tutor->salary }}" @endif>
                                    <small class="form-text text-info">This should be your minimum expected salary per month</small>

                                    @error('salary')
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
                                    name="email" @if(isset($tutor->user_email)) value="{{ $tutor->user_email }}" @else value="{{ old('email') }}" @endif>

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
                                        aria-describedby="inputMobilePrepend" @if(old('mobile')) value="{{ old('mobile') }}" @elseif($tutor->user_mobile) value="{{ $tutor->user_mobile }}" @endif>

                                    @error('mobile')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <small class="form-text text-info">Please provide the mobile no. you want receive calls
                                    from guardians</small>
                            </div>
                        </div>




                        <h5 class="card-title">Qualification</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Please provide most recent qualification</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">Level <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select class="custom-select @error('level') is-invalid @enderror" name="level">
                                    <option value=""> -- Please select -- </option>
                                    @foreach(levels_of_study() as $key => $level)
                                    <option value="{{ $key }}" @if(old('level') == $key) selected @elseif($tutor->level == $key) selected @endif> {{ $level }} </option>
                                    @endforeach 
                                </select>

                                @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject" class="col-md-4 col-form-label text-md-right">Subject <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" @if(old('subject')) value="{{ old('subject') }}" @elseif(isset($tutor->subject)) value="{{ $tutor->subject }}" @endif>

                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="institute" class="col-md-4 col-form-label text-md-right">Institute <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="institute" type="text" class="form-control @error('institute') is-invalid @enderror" name="institute" @if(old('institute')) value="{{ old('institute') }}" @elseif(isset($tutor->institute)) value="{{ $tutor->institute }}" @endif>

                                @error('institute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select class="custom-select @error('status') is-invalid @enderror" name="status">
                                    <option value=""> -- Please select -- </option>
                                    <option value="Studying" @if(old('status')=='Studying' ) selected @elseif($tutor->status == 'Studying') selected @endif> Studying </option>
                                    <option value="Completed" @if(old('status')=='Completed' ) selected @elseif($tutor->status == 'Completed') selected @endif> Completed </option>
                                </select>

                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="proof_of_doc" class="col-md-4 col-form-label text-md-right">Proof of Document <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                               
                                @if($tutor->proof_of_doc != '')
                                <img src="{{ asset('storage/'.$tutor->proof_of_doc) }}" class="img-thumbnail mb-3"
                                    alt="Proof of Document">
                                @endif

                                <input type="file" name="proof_of_doc" class="btn btn-sm btn-outline-secondary @error('proof_of_doc') is-invalid @enderror">
                                <small class="form-text text-info">i.e. Certificate, Registration card, Student photo card. Your profile will not be approved without a valid Proof of document.</small>

                                @error('proof_of_doc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="note" class="col-md-4 col-form-label text-md-right">Note</label>
                            <div class="col-md-6">
                                <textarea id="note" class="form-control @error('note') is-invalid @enderror" name="note">@if(old('note')){{ old('note') }}@elseif(isset($tutor->note)){{ $tutor->note }}@endif</textarea>
                                <small class="form-text text-info">Other information you want add about this qualification</small>

                                @error('note')
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
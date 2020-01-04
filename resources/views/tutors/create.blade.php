@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form method="POST" action="{{ url('/tutors') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-header">
                        <h5 class="card-title text-center">Tutor Profile</h5>
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
                            <label for="subjects" class="col-md-4 col-form-label text-md-right">Subjects <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea id="subjects" class="form-control @error('subjects') is-invalid @enderror" name="subjects">{{ old('subjects') }}</textarea>
                                <small class="form-text text-info">Please type subjects you will want provide tution</small>

                                @error('subjects')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="areas" class="col-md-4 col-form-label text-md-right">Areas <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea id="areas" class="form-control @error('areas') is-invalid @enderror" name="areas">{{ old('areas') }}</textarea>
                                <small class="form-text text-info">Please provide areas you will cover for tution</small>

                                @error('areas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="years" class="col-md-4 col-form-label text-md-right">Years <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea id="years" class="form-control @error('years') is-invalid @enderror" name="years">{{ old('years') }}</textarea>
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
                                    <input type="text" name="salary" class="form-control @error('salary') is-invalid @enderror" aria-describedby="inputsalaryPrepend" value="{{ old('salary') }}">
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




                        <h5 class="card-title">Qualification</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Please provide most recent qualification</h6>
                        <hr class="mt-0" />

                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">Level <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select class="custom-select @error('level') is-invalid @enderror" name="level">
                                    <option value=""> -- Please select -- </option>
                                    <option value="8" @if(old('level')==8) selected @endif> Ph.D. </option>
                                    <option value="7" @if(old('level')==7) selected @endif> Masters </option>
                                    <option value="6" @if(old('level')==6) selected @endif> Bachelor </option>
                                    <option value="5" @if(old('level')==5) selected @endif> Diploma </option>
                                    <option value="4" @if(old('level')==4) selected @endif> HSC </option>
                                    <option value="3" @if(old('level')==3) selected @endif> SSC </option>
                                    <option value="2" @if(old('level')==2) selected @endif> School Student </option>
                                    <option value="1" @if(old('level')==1) selected @endif> Other Training </option>
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
                                <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}">

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
                                <input id="institute" type="text" class="form-control @error('institute') is-invalid @enderror" name="institute" value="{{ old('institute') }}">

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
                                    <option value="Studying" @if(old('status')=='Studying' ) selected @endif> Studying </option>
                                    <option value="Completed" @if(old('status')=='Completed' ) selected @endif> Completed </option>
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
                                <input type="file" name="proof_of_doc" class="btn btn-sm btn-outline-secondary @error('proof_of_doc') is-invalid @enderror">
                                <small class="form-text text-danger"><span class="text-info">i.e. Certificate, Registration card, Student photo card.</span> Your profile will not be approved without a valid Proof of document.</small>

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
                                <textarea id="note" class="form-control @error('note') is-invalid @enderror" name="note">{{ old('note') }}</textarea>
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
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
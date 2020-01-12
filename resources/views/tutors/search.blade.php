<div class="row mb-3 justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <form method="POST" action="{{ url('/search/tutors') }}">
                @csrf

                <div class="card-body">
                    <h5 class="card-title text-center">Seach Tutors</h5>
                    <hr />
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="class">Covered class</label>
                            <select id="class" class="form-control" name="class">
                                <option selected value="">Choose...</option>
                                @foreach(years_of_study() as $key => $class)
                                <option value="{{$key}}" @if(old('class')==$key) selected @elseif(isset($input['class'])
                                    && $input['class']==$key) selected @endif> {{ $class }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subject">Covered subject</label>
                            <select id="subject" class="form-control" name="subject">
                                <option selected value="">Choose...</option>
                                @foreach(tution_subjects() as $subject)
                                <option value="{{$subject['name']}}" @if(old('subject')==$subject['name']) selected
                                    @elseif(isset($input['subject']) && $input['subject']==$subject['name']) selected
                                    @endif> {{
                                    $subject['name'] }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status">Qualification status</label>
                            <select id="status" class="form-control" name="status">
                                <option selected value="">Choose...</option>
                                <option value="Studying" @if(old('status')=='Studying' ) selected @elseif(isset($input['status']) && $input['status'] == 'Studying') selected @endif> Studying </option>
                                <option value="Completed" @if(old('status')=='Completed' ) selected @elseif(isset($input['status']) && $input['status'] == 'Completed') selected @endif> Completed </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="level">Qualification level</label>
                            <select id="level" class="form-control" name="level">
                                <option selected value="">Choose...</option>
                                @foreach(levels_of_study() as $key => $level)
                                    <option value="{{ $key }}" @if(old('level') == $key) selected @elseif(isset($input['level']) && $input['level'] == $key) selected @endif> {{ $level }} </option>
                                    @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="location">Covered location</label>
                            <select id="location" class="form-control" name="location">
                                <option selected value="">Choose...</option>
                                @foreach(locations() as $location)
                                <option value="{{$location['name']}}" @if(old('subject')==$location['name']) selected
                                    @elseif(isset($input['location']) && $input['location']==$location['name']) selected
                                    @endif> {{
                                    $location['name'] }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary"
                                @if(isset($input['salary'])) value="{{ $input['salary'] }}" @endif>
                        </div>
                    </div>

                    <div class="text-center d-block w-100">
                        <hr />
                        <button type="submit" class="btn btn-sm btn-primary pl-5 pr-5 mr-2">Search</button>
                        
                        @if(isset($input) && count($input) > 0)
                        <a href="{{ url('/tutors') }}" class="btn btn-sm btn-outline-secondary pl-5 pr-5">All
                            tutors</a>

                        <hr />
                        <h5 class="text-info">{{ $tutors->total() }} tutor(s) found on search</5>

                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
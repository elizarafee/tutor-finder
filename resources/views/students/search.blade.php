<div class="row mb-3 justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <form method="POST" action="{{ url('/search/students') }}">
                @csrf

                <div class="card-body">
                    <h5 class="card-title text-center">Seach Students</h5>
                    <hr />
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="class">Class</label>
                            <select id="class" class="form-control" name="class">
                                <option selected value="">Choose...</option>
                                @foreach(years_of_study() as $key => $class)
                                <option value="{{$key}}" @if(old('class')==$key) selected @elseif(isset($input['class'])
                                    && $input['class']==$key) selected @endif> {{ $class }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subject">Subject</label>
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
                            <label for="location">Location</label>
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
                            <label for="budget">Budget</label>
                            <input type="text" class="form-control" id="budget" name="budget"
                                @if(isset($input['budget'])) value="{{ $input['budget'] }}" @endif>
                        </div>
                    </div>

                    <div class="text-center d-block w-100">
                        <hr />
                        <button type="submit" class="btn btn-sm btn-primary pl-5 pr-5 mr-2">Search</button>
                        
                        @if(isset($input) && count($input) > 0)
                        <a href="{{ url('/students') }}" class="btn btn-sm btn-outline-secondary pl-5 pr-5">All
                            students</a>

                        <hr />
                        <h5 class="text-info">{{ $students->total() }} student(s) found on search</5>

                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
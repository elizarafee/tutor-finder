@if($tutors['rejected']->count()) 
                    <table class="table table-sm table-hover table-bordered">
                        <thead class="thead bg-danger text-white">
                            <tr>
                                <th scope="col">{{ $tutors['rejected']->count() }} {{ ($tutors['rejected']->count() > 1)? 'tutors' : 'tutor' }} profile was rejected</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tutors['rejected'] as $tutor)
                            <tr>
                                <td>
                                    <a href="{{ url('/tutors/'.$tutor->id) }}">{{$tutor->first_name.' '.$tutor->last_name}}</a> 
                                    <small class="text-muted">rejected for {{$tutor->rejection_reason}} at {{date('j M Y g:i a', strtotime($tutor->rejected_at))}}</small>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else 
                    <div class="alert alert-success" role="alert">
                        No tutor was rejected.
                    </div>
                    @endif 
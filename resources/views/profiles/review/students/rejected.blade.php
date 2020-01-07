@if($students['rejected']->count()) 
                    <table class="table table-sm table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{ $students['rejected']->count() }} guardians profile rejected</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students['rejected'] as $student)
                            <tr>
                                <td>
                                    <a href="{{ url('/students/'.$student->id) }}">{{$student->first_name.' '.$student->last_name}}</a> 
                                    <small class="text-muted">requested at {{date('j M Y g:i a', strtotime($student->completed_at))}}</small>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else 
                    <div class="alert alert-success" role="alert">
                        No guadians profile is rejected.
                    </div>
                    @endif
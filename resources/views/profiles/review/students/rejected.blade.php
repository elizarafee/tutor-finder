@if($students['rejected']->count())
<table class="table table-sm table-hover table-bordered">
    <thead class="thead bg-danger text-white">
        <tr>
            <th scope="col">{{ $students['rejected']->count() }} {{ ($students['rejected']->count() > 1)? 'guardians' :
                'guardian' }} profile rejected</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students['rejected'] as $student)
        <tr>
            <td>
                <a href="{{ url('/students/'.$student->id) }}">{{$student->first_name.' '.$student->last_name}}</a>
                <small class="text-muted">rejected for {{$student->rejection_reason}} at {{date('j M Y g:i a',
                    strtotime($student->rejected_at))}}</small>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-success" role="alert">
    No guadian was rejected.
</div>
@endif
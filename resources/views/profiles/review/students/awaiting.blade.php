@if($students['awaiting']->count())
<table class="table table-sm table-hover table-bordered">
    <thead class="thead bg-info">
        <tr>
            <th scope="col">{{ $students['awaiting']->count() }} {{ ($students['awaiting']->count() > 1)? 'guardians' : 'guardian' }} awaiting for approval</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students['awaiting'] as $student)
        <tr>
            <td>
                <a href="{{ url('/students/'.$student->id) }}">{{$student->first_name.' '.$student->last_name}}</a>
                <small class="text-muted">requested at {{date('j M Y g:i a',
                    strtotime($student->completed_at))}}</small>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-success" role="alert">
    No guardian awaiting for approval.
</div>
@endif
@if($tutors['awaiting']->count())
<table class="table table-sm table-hover table-bordered">
    <thead class="thead bg-info">
        <tr>
            <th scope="col">{{ $tutors['awaiting']->count() }} {{ ($tutors['awaiting']->count() > 1)? 'tutors' : 'tutor'
                }} awaiting for approval</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tutors['awaiting'] as $tutor)
        <tr>
            <td>
                <a href="{{ url('/tutors/'.$tutor->id) }}">{{$tutor->first_name.' '.$tutor->last_name}}</a>
                <small class="text-muted">requested at {{date('j M Y g:i a', strtotime($tutor->completed_at))}}</small>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-success" role="alert">
    No tutor awaiting for approval.
</div>
@endif
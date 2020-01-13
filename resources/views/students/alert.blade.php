@if($connection['request'] == 'received' && $connection['connected'] == false)
<div class="alert alert-warning" role="alert">
    {{$student->first_name}} {{$student->last_name}} requested you to connect at {{date('j M Y g:ia',
    strtotime($connection['time']))}}.
</div>
@endif
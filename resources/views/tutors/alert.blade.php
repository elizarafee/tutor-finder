@if($connection['request'] == 'received' && $connection['connected'] == false)
<div class="alert alert-warning" role="alert">
    {{$tutor->first_name}} {{$tutor->last_name}} requested you to connect at {{date('j M Y g:ia',
    strtotime($connection['time']))}}.
</div>
@endif
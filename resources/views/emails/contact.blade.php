@component('mail::message')
# Notification 

You received message from {{ $contact['name'] }} ({{ $contact['email'] }}).<br/>

{!! nl2br(e($contact['msg'])) !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

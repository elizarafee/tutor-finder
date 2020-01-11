@component('mail::message')
# Notification

Dear {{$first_name}},
You received a new request to connect from {{$requested_by}}.
Please respond.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

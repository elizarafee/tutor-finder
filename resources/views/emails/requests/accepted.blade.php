@component('mail::message')
# Notification

Dear {{$first_name}},
{{$accepted_by}} has accepted your request to connect.
Now you will be able to see his/her details.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Notification

A profile has been updated by {{$full_name}} ({{$type}}). Please review the profile to approve. 


Thanks,<br>
{{ config('app.name') }}
@endcomponent

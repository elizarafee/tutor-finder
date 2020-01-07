@component('mail::message')
# Notification 

Dear {{$first_name}},<br/>
We are pleased to let you know that your profile has been approved.<br/> 

@component('mail::button', ['url' => $url])
Login to find {{$user_type}}
@endcomponent

Best Regards,<br>
{{ config('app.name') }}
@endcomponent

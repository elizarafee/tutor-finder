@component('mail::message')
# Notification 

Dear {{$first_name}},<br/>
We are sorry to let you know that your profile has been disapproved.<br/> 

Please rectifiy the following reason by updating your profile.<br/>

{{ $reason }}

@component('mail::button', ['url' => $url])
Please login
@endcomponent

Best Regards,<br>
{{ config('app.name') }}
@endcomponent

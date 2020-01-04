@component('mail::message')
# Notification 

Dear {{$first_name}},<br/>
Thank for updating your profile.<br/>
Admin will review it shortly to approve.<br/> 

Best Regards,<br>
{{ config('app.name') }}
@endcomponent

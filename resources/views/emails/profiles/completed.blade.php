@component('mail::message')
# Introduction

A tutor has been registered in Tutor Finder. Please review the profile. 

@component('mail::button', ['url' => ''])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Forgot Password Mail

This is Your OTP for verifiy your Email !!

To: {{$data->email}}<br>
<b>Your OTP to verify your email {{$otp}}</b><br>
Thank You 😊<br>

{{ config('app.name') }}
@endcomponent

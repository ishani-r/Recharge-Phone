@component('mail::message')
# Replay Mail

Thank you for contacting us.<br>
Your Messages : <br>
{{$message}}
<br><br>
Replay By Admin : <br>
{{$replay}}

Thank You 😊<br>
<!-- {{ config('app.name') }} -->
@endcomponent

@component('mail::message')
# Hello {{ $user->username }}!

We've been noticed that you are changing your email
<br><br>

From : {{ $oldEmail }}
<br> 

To : {{ $user->email }}
<br>

Please verify again if you mean to change your email.

@component('mail::button', ['url' => $urlVerification])
Verify Now
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent

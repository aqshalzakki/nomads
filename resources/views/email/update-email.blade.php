@component('mail::message')
# Update Email Message

We've been noticed that you are updating your email
<br><br>

From : {{ $oldEmail }}
<br> 

To : {{ $user->email }}
<br>

Please verify again if you change your email.

@component('mail::button', ['url' => $urlVerification])
Verify Now
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent

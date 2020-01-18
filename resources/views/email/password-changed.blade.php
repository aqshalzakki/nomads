@component('mail::message')
# Password Changed
Hello {{ $user->username }}!

We've been noticed that your password was just changed in a few minutes ago..
<br>
You did'nt change the password?
<br>
click a button below if you was'nt change a password
<br>

@component('mail::button', ['url' => ''])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

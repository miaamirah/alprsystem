@component('mail::message')

# Hello {{ $user->name ?? 'User' }}!

We received a request to reset the password for your ALPR System account.

@component('mail::button', ['url' => $url])
Reset My Password
@endcomponent

This password reset link will expire in 60 minutes for your security.

If you did not request a password reset, you can safely ignore this email and no changes will be made.

Thank you,<br>
**ALPR System Team**

@slot('subcopy')
If you're having trouble clicking the "Reset My Password" button, copy and paste the URL below into your web browser: [{{ $url }}]({{ $url }})
@endslot

@endcomponent

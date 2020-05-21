@component('mail::message')
Enter below code to reset your password.

# Code: {{ $token }}

This code will expire in 60 minutes.
Remember! Once the password changed the token expires automatically.

Thanks for registering,<br>
{{ config('app.name') }}
@endcomponent

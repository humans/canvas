@component('mail::message')
# Welcome to {{ config('app.name') }}, {{ $user->name }}

Huzzah! Your account is now activated!

Welcome to our humble abode. Hope you enjoy your stay, we worked hard on it.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

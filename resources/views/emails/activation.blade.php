@component('mail::message')
# Activate Your Account

Hey there, {{ $user->name }}! Thank you for signing up for {{ config('app,name') }}.

Before we can start with the app, we just have to make sure you're not a robot. Those pesky AIs are getting pretty smart!

Don't worry, all you have to do is click the big blue button below and you'll be able to log in.

@component('mail::button', ['url' => $activation])
I'm Human
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

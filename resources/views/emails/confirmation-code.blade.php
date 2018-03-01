@component('mail::message')
# Confirm your email with the following code

Thank you for signing up for {{ config('app.name') }}. We're happy you're here!

Enter the following code in the window where you began your registration:

<p style="font-size: 60px; margin: 0; text-align: center;">{{ $code }}</p>

Best Wishes,
{{ config('app.name') }}

@endcomponent

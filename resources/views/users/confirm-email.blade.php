<h1>Check your email</h1>

<p>We've sent an activation link to <strong>{{ session('email') }}</strong>. It will expire shortly, so activate your account soon.</p>

<p>
    <small>Haven't received our email? Try your spam folder!</small>

    <form action="">
        @csrf

        <button type="submit">Click here to resend the activation mail</button>
    </form>
</p>


@if(app()->environment('local'))
    <small>
        <a href="{{ route('activate', ['token' => session('activation_token')]) }}">
            Psst. You're a developer, here's a link to activate your account.
        </a>
    </small>
@endif

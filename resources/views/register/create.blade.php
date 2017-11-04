<form method="POST" action="{{ route('register.store') }}">
    {{ csrf_field() }}

    <input name="name" type="text">
    <input name="email" type="text">
    <input name="password" type="password">
    <input name="password_confirmation" type="password">

    <button type="submit">Register</button>
</form>

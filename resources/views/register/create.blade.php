<form method="POST" action="{{ route('register.store') }}">
    {{ csrf_field() }}

    <input name="name" type="text" value=""/>
    <input name="email" type="text" value=""/>
    <input name="password" type="password" value=""/>
    <input name="password_confirmation" type="password" value=""/>

    <button type="submit">Register</button>
</form>

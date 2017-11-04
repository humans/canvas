<form method="POST" action="{{ route('login.store') }}">
    {{ csrf_field() }}

    <input name="email" type="text" value=""/>
    <input name="password" type="password" value=""/>

    <button type="submit">Login</button>
</form>

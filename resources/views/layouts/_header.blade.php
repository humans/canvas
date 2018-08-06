<header class="app-header">
    <div class="wrapper">
        <h1 class="brand">
            <a href="{{ route('home') }}">{{ config('app.name') }}</a>
        </h1>

        <nav class="actions ml-auto">
            @auth
                <ul class="list-reset flex">
                    @impersonating
                        <li><a href="{{ route('impersonate.leave') }}">End Impersonation</a></li>
                    @else
                        @canImpersonate
                            <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        @endCanImpersonate
                    @endImpersonating

                    <li class="ml-4"><a href="{{ route('logout') }}">Sign Out</a></li>
                </ul>
            @else
                <a class="link" href="{{ route('login') }}">Login</a>
            @endauth
        </nav>
    </div>
</header>

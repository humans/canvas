<header class="header">
    <div class="wrapper [ flex items-center py-8 ]">
        <h1 class="brand [ text-xl ]">
            <a class="[ text-black no-underline hover:text-blue ]" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </h1>

        <nav class="right [ ml-auto text-sm ]">
            @auth
                <ul class="[ list-reset flex ]">
                    @impersonating
                        <li><a href="{{ route('impersonate.leave') }}">End Impersonation</a></li>
                    @else
                        <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                    @endImpersonating

                    <li class="[ ml-16 ]"><a href="{{ route('logout') }}">Sign Out</a></li>
                </ul>
            @else
                <a class="button" href="{{ route('login') }}">Login</a>
            @endauth
        </nav>
    </div>
</header>
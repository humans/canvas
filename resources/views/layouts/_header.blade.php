<header class="header">
    <div class="wrapper [ flex items-center py-8 ]">
        <h1 class="brand [ ms-xl ]">
            <a class="[ text-black no-underline hover:text-blue ]" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </h1>

        <nav class="right [ ml-auto ]">
            @auth
                <ul class="[ list-reset flex ]">
                    @impersonating
                        <li><a href="{{ route('impersonate.leave') }}">End Impersonation</a></li>
                    @else
                        @canImpersonate
                            <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        @endCanImpersonate
                    @endImpersonating

                    <li class="[ ml-4 ]"><a href="{{ route('logout') }}">Sign Out</a></li>
                </ul>
            @else
                <a class="button button-primary" href="{{ route('login') }}">Login</a>
            @endauth
        </nav>
    </div>
</header>

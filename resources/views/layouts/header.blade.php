<header class="header">
    <div class="wrapper [ flex items-center py-8 ]">
        <h1 class="brand [ text-2xl ]">{{ config('app.name') }}</h1>

        <div class="right [ ml-auto ]">
            @auth
                <a href="#">{{ $me->name }}</a>

                <nav class="dropdown">
                </nav>
            @else
                <a class="button" href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </div>
</header>
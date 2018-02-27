<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>
           @yield('title', config('app.name'))
        </title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <script>
            window.App = window.Laravel = {!! json_encode([
                'csrfToken'  => csrf_token(),
                'hasSession' => !! $me,
                'pusher' => [
                    'key'     => config('broadcasting.connections.pusher.key'),
                    'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                ],
            ]) !!}
        </script>
    </head>
    <body class="[ font-sans leading-normal tracking-normal text-base text-black ]">
        <main id="app">
            @include('layouts.header')

            <section class="content">
                @impersonating
                <section class="wrapper [ text-sm text-grey-darker ]">
                    <p>@lang('messages.impersonation_notice', ['name' => $me->name])</p>
                </section>
                @endImpersonating

                @yield('content')
            </section>
        </main>

        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>

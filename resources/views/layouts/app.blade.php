<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @if(! app()->environment('production'))
        <meta name="robots" content="noindex">
        @endif

        <title>
           @yield('title', config('app.name'))
        </title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <script>
            window.App = window.Laravel = {!! json_encode([
                'csrfToken'  => csrf_token(),
                'hasSession' => !! auth()->user(),
                'pusher' => [
                    'key'     => config('broadcasting.connections.pusher.key'),
                    'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                ],
            ]) !!}
        </script>
    </head>

    <body>
        <main id="app">
            @partial('layouts.header')

            <section class="content">
                @yield('content')
            </section>

            @impersonating
            <section class="wrapper [ ms-sm text-grey-darker ]">
                <p>@lang('messages.impersonation_notice', ['name' => auth()->user()->name])</p>
            </section>
            @endImpersonating
        </main>

        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>

        @stack('scripts')

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>

@extends('layouts.app')

@section('content')
    <div class="wrapper">

        @if($me->is_admin)
            <a href="">Admin</a>
        @endif

        @impersonating
        Impersonating {{ $me->name }}

        <a href="{{ route('impersonate.leave') }}">Leave Impersonation</a>
        @endImpersonating

        <h1>Home</h1>

        <p>
            <small>
                Hey <strong v-html="user.name"></strong>! This part is a small demo of Laravel Passport working out of the box.
            </small>
        </p>
    </div>
@endsection

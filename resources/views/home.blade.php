@extends('layouts.app')

@section('content')
    <h1 v-html="user.name"></h1>

    @if($me->is_admin)
        <a href="">Admin</a>
    @endif

    @impersonating
    Impersonating {{ $me->name }}

    <a href="{{ route('impersonate.leave') }}">Leave Impersonation</a>
    @endImpersonating

    Home
@endsection

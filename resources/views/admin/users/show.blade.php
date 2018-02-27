@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}</h1>

    @canBeImpersonated($user)
    <a href="{{ route('impersonate', $user) }}">Impersonate</a>
    @endCanBeImpersonated
@endsection

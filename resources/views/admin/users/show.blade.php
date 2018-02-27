@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}</h1>

    <a href="{{ route('impersonate', $user) }}">Impersonate</a>
@endsection

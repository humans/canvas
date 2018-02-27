@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <h1>Dashboard</h1>

        <ul>
            <li><a href="{{ route('admin.users.index') }}">Users</a></li>
        </ul>
    </div>
@endsection
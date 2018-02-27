@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <table class="[ w-full ]">
            <thead class="[ text-left ]">
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
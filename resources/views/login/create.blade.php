@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login.store') }}">
        {{ csrf_field() }}

        @component('fields.text', [
            'label' => 'Email Address',
            'name'  => 'email',
        ])
        @endcomponent

        @component('fields.password', [
            'label' => 'Password',
            'name'  => 'password',
        ])
        @endcomponent

        <div class="field">
            <label>
                <input type="checkbox" name="remember">
                Remember Me?
            </label>
        </div>

        <button type="submit">Login</button>
    </form>
@endsection

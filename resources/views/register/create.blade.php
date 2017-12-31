@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register.store') }}">
        {{ csrf_field() }}

        @component('fields.text', [
            'label' => 'Name',
            'name'  => 'name',
        ])
        @endcomponent

        @component('fields.text', [
            'label' => 'Email Address',
            'name'  => 'email',
        ])
        @endcomponent

        <div class="password-fields [ flex ]">
            @component('fields.password', [
                'label' => 'Password',
                'name'  => 'password',
            ])
            @endcomponent

            @component('fields.password', [
                'label' => 'Repeat Password',
                'name'  => 'password_confirmation',
            ])
            @endcomponent
        </div>

        <button class="button" type="submit">Register</button>
    </form>
@endsection

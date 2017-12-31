@extends('layouts.app')

@section('content')
    <section class="login-form">
        <div class="wrapper [ max-w-sm mt-8 ]">
            <h1 class="[ mb-4 ]">Login to {{ config('app.name') }}</h1>

            <form method="POST" action="{{ route('login.store') }}">
                {{ csrf_field() }}

                @component('fields.text', [
                    'label' => 'Email Address',
                    'name'  => 'email',
                ])
                @endcomponent

                @component('fields.password', [
                    'label'     => 'Password',
                    'name'      => 'password',
                    'utilities' => 'mt-2',
                ])
                @endcomponent

                <div class="field [ mt-2 ]">
                    <label>
                        <input type="checkbox" name="remember">
                        Remember Me?
                    </label>
                </div>

                <button class="button [ mt-4 ]" type="submit">Login</button>
            </form>
        </div>
    </section>
@endsection

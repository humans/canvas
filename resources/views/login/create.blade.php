@extends('layouts.app')

@section('content')
    <section class="login-form">
        <div class="wrapper [ max-w-sm mt-32 ]">
            <h1 class="[ mb-16 ]">Login to {{ config('app.name') }}</h1>

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
                    'utilities' => 'mt-8',
                ])
                @endcomponent

                <div class="field [ mt-8 ]">
                    <label>
                        <input type="checkbox" name="remember">
                        Remember Me?
                    </label>
                </div>

                <button class="button [ mt-16 ]" type="submit">Login</button>
            </form>
        </div>
    </section>
@endsection

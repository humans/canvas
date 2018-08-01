@extends('layouts.app')

@section('content')
    <section class="login-form [ py-8 ]">
        <div class="wrapper [ max-w-sm ]">
            <h1 class="[ mb-6 ]">Login to {{ config('app.name') }}</h1>

            @if($message = session('message'))
                <p>{{ $message }}</p>
            @endif

            <form class="flex flex-col" method="POST" action="{{ route('login.store') }}">
                @csrf

                @textfield([
                    'label' => 'Email address or Username',
                    'name'  => 'login',
                ])

                @passwordfield([
                    'label' => 'Password',
                    'name'  => 'password',
                    'class' => 'mt-4',
                ])

                <div class="field [ mt-4 flex ]">
                    <label>
                        <input type="checkbox" name="remember">
                        Remember Me?
                    </label>

                    <a class="[ ml-auto no-underline ]" href="{{ route('confirmation-codes.create') }}">Join Us</a>
                </div>

                <button class="button button-primary [ mt-6 ml-auto ]" type="submit">Login</button>
            </form>
        </div>
    </section>
@endsection

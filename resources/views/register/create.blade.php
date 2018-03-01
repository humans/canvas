@extends('layouts.app')

@section('content')
    <section class="register-form">
        <div class="wrapper [ max-w-sm mt-8 ]">
            <h1 class="[ mb-4 ]">Register to {{ config('app.name') }}</h1>

            <form method="POST" action="{{ route('register.store') }}">
                {{ csrf_field() }}

                @textfield([
                    'label' => 'Name',
                    'name'  => 'name',
                    'utilities' => 'mt-8',
                ])

                @textfield([
                    'label' => 'Username',
                    'name'  => 'username',
                    'utilities' => 'mt-8',
                ])

                <div class="password-fields [
                        flex flex-col
                        md:flex-row md:justify-between md:mt-8
                    ]">
                    @passwordfield([
                        'label'     => 'Password',
                        'name'      => 'password',
                        'utilities' => 'mt-2 md:mt-0 md:mr-2',
                    ])

                    @passwordfield([
                        'label'     => 'Repeat Password',
                        'name'      => 'password_confirmation',
                        'utilities' => 'mt-2 md:mt-0 md:ml-2',
                    ])
                </div>

                <button class="button [ mt-16 ]" type="submit">Register</button>
            </form>
        </div>
    </section>
@endsection

@extends('layouts.app')

@push('scripts')
<script src="{{ mix('js/register.js') }}"></script>
@endpush

@section('content')
    <register-form email="{{ $email }}" errors="{{ $errors }}" inline-template>
        <section class="registration">
            <div class="wrapper [ max-w-sm mt-8 ]">
                <section class="confirm-email" v-if="! showProfileForm">
                    <h1 class="[ mb-4 ]">Check your email</h1>

                    <p>
                        We’ve sent a six-digit confirmation code to <strong>{{ $email }}</strong>. It will expire shortly, so enter your code soon.
                    </p>

                    <form method="POST"
                          action="{{ route('api.email.confirm') }}"
                          ref="confirmationForm" @submit.prevent="confirm">
                        @csrf

                        @textfield([
                            'label'     => 'Your confirmation code',
                            'name'      => 'code',
                            'model'     => 'code',
                            'utilities' => 'mt-16',
                        ])

                        <p class="[ text-sm ]" v-if="error" v-text="error"></p>


                        <button class="button [ mt-16 ]" type="submit" :disabled="processing">
                            Confirm Email
                        </button>
                    </form>

                    @local
                    <p class="[ text-sm mt-16 text-grey-dark ]">
                        Navi here! Your confirmation code is: <strong>{{ App\ConfirmationCode::whisper() }}</strong>.
                    </p>
                    @endlocal
                </section>

                <section class="profile" v-if="showProfileForm">
                    <h1 class="[ mb-4 ]">Register to {{ config('app.name') }}</h1>

                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        @textfield([
                            'label'     => 'Name',
                            'name'      => 'name',
                            'utilities' => 'mt-16',
                        ])

                        @textfield([
                            'label'     => 'Username',
                            'name'      => 'username',
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
                </section>
            </div>
        </section>
    </register-form>
@endsection
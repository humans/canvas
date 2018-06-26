<section class="confirm-email" v-if="! showProfileForm">
    <h1 class="[ mb-2 ]">Check your email</h1>

    <p>We’ve sent a six-digit confirmation code to <strong>{{ $email }}</strong>. It will expire shortly, so enter your code soon!</p>

    <form class="flex flex-col" method="POST" action="{{ route('api.email.confirm') }}" ref="confirmationForm" @submit.prevent="confirm">
        @csrf

        @textfield([
            'label' => 'Your confirmation code',
            'name'  => 'code',
            'model' => 'code',
            'class' => 'mt-4',
        ])

        <p class="[ text-14 ]" v-if="error" v-text="error"></p>

        @local
        <p class="[ ms-sm mt-1 text-grey-dark ]">
            Navi here! Your confirmation code is: <strong>{{ App\ConfirmationCode::whisper() }}</strong>.
        </p>
        @endlocal

        <button class="button button-primary [ mt-6 ml-auto ]" type="submit" :disabled="processing">
            Confirm Email
        </button>
    </form>
</section>

<section class="profile" v-if="showProfileForm">
    <h1>Complete your profile</h1>
    <p class="text-grey-darker">Just one more step before you're in!</p>

    <form class="mt-4 flex flex-col" method="POST" action="{{ route('register.store') }}">
        @csrf

        @textfield([
            'label' => 'Name',
            'name'  => 'name',
        ])

        @textfield([
            'label' => 'Username',
            'name'  => 'username',
            'class' => 'mt-4',
        ])

        <div class="password-fields flex flex-col md:flex-row md:justify-between md:mt-4">
            @passwordfield([
                'label' => 'Password',
                'name'  => 'password',
                'class' => 'mt-4 md:mt-0 md:mr-2 w-full',
            ])

            @passwordfield([
                'label' => 'Repeat Password',
                'name'  => 'password_confirmation',
                'class' => 'mt-4 md:mt-0 md:ml-2 w-full',
            ])
        </div>

        <button class="button button-primary mt-4 ml-auto" type="submit">Register</button>
    </form>
</section>

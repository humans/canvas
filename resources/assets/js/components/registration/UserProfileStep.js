import TextField from '../TextField.js'
import PasswordField from '../PasswordField.js'

export default {
    name: 'UserProfileStep',

    render(h) {
        return (
            <section class="step user-profile">
                <h1>Complete your profile</h1>
                <p class="text-grey-darker">Just one more step before you're in!</p>

                {this.errors}

                <form class="mt-4 flex flex-col" method="POST" action="/register">
                    <input type="hidden" name="_token" value={window.App.csrfToken} />

                    <TextField label="Name" input="name" />

                    <TextField class="mt-4" label="Username" input="username" />

                    <div class="password-fields flex flex-col md:flex-row md:justify-between md:mt-4">
                        <PasswordField class="mt-4 md:mt-0 md:mr-2 w-full" type="password" label="Password" input="password" />

                        <PasswordField class="mt-4 md:mt-0 md:ml-2 w-full" type="password" label="Repeat Password" input="password_confirmation" />
                    </div>

                    <button type="submit" class="button button-primary mt-4 ml-auto">Register</button>
                </form>                
            </section>
        )
    },
}

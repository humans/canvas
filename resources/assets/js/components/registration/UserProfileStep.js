import TextField from '../TextField.js'
import PasswordField from '../PasswordField.js'

export default {
    name: 'UserProfileStep',

    render(h) {
        return (
            <section class="wizard-step user-profile-step">
                <h1 class="title">Complete your profile</h1>

                <p class="lead">Just one more step before you're in!</p>

                <form class="form" method="POST" action="/register">
                    <input type="hidden" name="_token" value={window.App.csrfToken} />

                    <TextField
                        label="Name"
                        input="name"
                        message={this.error('name')}
                        value={this.value('name')} />

                    <TextField
                        class="mt-4"
                        label="Username"
                        input="username"
                        message={this.error('username')}
                        value={this.value('username')} />

                    <div class="password-fields">
                        <PasswordField
                            class="mt-4 md:mt-0 md:mr-2 w-full"
                            label="Password"
                            input="password"
                            message={this.error('password')} />

                        <PasswordField
                            class="mt-4 md:mt-0 md:ml-2 w-full"
                            label="Repeat Password"
                            input="password_confirmation" />
                    </div>

                    <button type="submit" class="button -primary mt-4 ml-auto">Register</button>
                </form>
            </section>
        )
    },

    props: ['errors', 'old'],

    methods: {
        error(key) {
            if (! this.errors.hasOwnProperty(key)) {
                return null
            }

            return this.errors[key][0]
        },

        value(key) {
            if (! this.old.hasOwnProperty(key)) {
                return null
            }

            return this.old[key]
        },
    },
}

import TextField from '../TextField.js'
import PasswordField from '../PasswordField.js'

export default {
    name: 'UserProfileStep',

    render(h) {
        return (
            <section class="step user-profile">
                <h1>Complete your profile</h1>
                <p class="text-grey-darker">Just one more step before you're in!</p>

                <form class="mt-4 flex flex-col" method="POST" action="/register">
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

                    <div class="password-fields flex flex-col md:flex-row md:justify-between md:mt-4">
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

                    <button type="submit" class="button button-primary mt-4 ml-auto">Register</button>
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

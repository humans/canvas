import ConfirmEmailStep from './ConfirmEmailStep.js'
import UserProfileStep from './UserProfileStep.js'
import { renderIf } from '../../helpers.js'

export default {
    name: 'RegisterFormWizard',

    render(h) {
        return (
            <section class="register-form-wizard">
                <div class="wrapper [ max-w-sm mt-8 ]">
                    {renderIf(
                        ! this.showProfileForm,
                        <ConfirmEmailStep email={this.email} onSuccess={this.next} />
                    )}

                    {renderIf(
                        this.showProfileForm,
                        <UserProfileStep />
                    )}
                </div>
            </section>
        )
    },

    props: {
        email: String,
        errors: {
            default: () => [],
        },
    },

    computed: {
        hasErrors() {
            return !! Object.keys(this.errors).length
        },

        /**
         * The errors are for the user profile form so if there are errors,
         * we can immediately jump straight to that step.
         *
         * @return Boolean
         */
        showProfileForm() {
            return this.hasErrors || this.confirmed
        },
    },

    data() {
        return { confirmed: false }
    },

    methods: {
        next() {
            this.confirmed = true
        },
    },
}

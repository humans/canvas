import ConfirmEmailStep from './ConfirmEmailStep.js'

export default {
    render(h) {
        return <section class="register-form-wizard">
            <div class="wrapper [ max-w-sm mt-8 ]">
                <ConfirmEmailStep />
            </div>
        </section>
    },

    props: {
        email: String,
        errors: {
            default: () => [],
        },
    },

    computed: {
        hasErrors() {
            return !! Object.keys(JSON.parse(this.errors)).length
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

    data () {
        return {
            code:       null,
            processing: false,
            confirmed:  false,
            error:      null,
        }
    },
}
import ConfirmEmailStep from './ConfirmEmailStep.js'

export default {
    render(h) {
        return <section class="register-form-wizard">
            <div class="wrapper [ max-w-sm mt-8 ]">
                <ConfirmEmailStep email={this.email} onSuccess={this.next} />
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

    methods: {
        next() {
            console.error('test')
        },
    },
}

import axios from 'axios'
import TextField from '../TextField';

export default {
    name: 'ConfirmEmailStep',

    render(h) {
        return <section class="step confirm-email">
            <h1 class="[ mb-2 ]">Check your email</h1>

            <p>We’ve sent a six-digit confirmation code to <strong>{ this.email }</strong>. It will expire shortly, so enter your code soon!</p>

            <form action="/api/confirm-email" method="POST" class="[ flex flex-col mt-4 ]" ref="form" onSubmit={ this.confirm }>
                <TextField
                    label="Your confirmation code"
                    message={ this.errorMessage }
                    onInput={ event => this.code = event.target.value } />

                <button class="button button-primary [ mt-6 ml-auto ]" type="submit" disabled={ ! this.isValid }>
                    Confirm Email
                </button>
            </form>
        </section>
    },

    props: ['email'],

    computed: {
        isValid() {
            return this.code && ! this.isProcessing
        },
    },

    data() {
        return {
            code: null,
            errorMessage: null,
            isProcessing: false,
        }
    },

    methods: {
        confirm(event) {
            event.preventDefault()

            if (! this.isValid) {
                return
            }

            this.isProcessing = true

            axios.post(this.$refs.form.action, { code: this.code, email: this.email })
                .then(() => this.$emit('success'))
                .catch(({ response }) => {
                    this.errorMessage = response.data.message
                    this.isProcessing = false
                })
        },
    },
}
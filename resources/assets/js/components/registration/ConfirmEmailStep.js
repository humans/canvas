import axios from 'axios'
import TextField from '../TextField.js'
import { when } from '../../helpers.js'

export default {
    name: 'ConfirmEmailStep',

    render(h) {
        return (
            <section class="wizard-step">
                <h1 class="title">Check your email</h1>

                <p>We’ve sent a six-digit confirmation code to <strong>{this.email}</strong>. It will expire shortly, so enter your code soon!</p>

                <form action="/api/confirm-email" method="POST" class="[ flex flex-col mt-4 ]" ref="form" onSubmit={this.confirm}>
                    <TextField
                        label="Your confirmation code"
                        input="code"
                        message={this.errorMessage}
                        onInput={(event) => this.code = event.target.value} />

                    {when(
                        this.whisper,
                        <p class="ms-sm mt-1 text-grey-dark">Hey, Navi here. Your confirmation code is <strong>{this.whisper}</strong>!</p>
                    )}

                    <button class="button -primary [ mt-6 ml-auto ]" type="submit" disabled={this.isNotValid}>
                        Confirm Email
                    </button>
                </form>
            </section>
        )
    },

    props: ['email'],

    computed: {
        isNotValid() {
            return ! this.code || this.isProcessing
        },
    },

    data() {
        return {
            whisper: this.listenForWhispers(),
            code: null,
            errorMessage: null,
            isProcessing: false,
        }
    },

    methods: {
        /**
         * This will look up if the confirmation code is being sent by the server
         * to avoid having to look up the database when developing the page.
         *
         * Hopefully, this will only be in the local env.
         */
        listenForWhispers() {
            if (! window.App) {
                return null
            }

            return window.App.whisper
        },

        confirm(event) {
            event.preventDefault()

            if (this.isNotValid) {
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

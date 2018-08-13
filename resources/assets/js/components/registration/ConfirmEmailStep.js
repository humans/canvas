import { when } from '../../helpers.js'
import axios from 'axios'
import TextField from '../TextField.js'

export default {
    name: 'ConfirmEmailStep',

    render(h) {
        return (
            <section class="wizard-step">
                <h1 class="title">Check your email</h1>

                <p class="lead">We’ve sent a six-digit confirmation code to <strong>{this.email}</strong>. It will expire shortly, so enter your code soon!</p>

                <form action="/api/confirm-email" method="POST" class="form" ref="form" onSubmit={this.confirm}>
                    <TextField
                        label="Your confirmation code"
                        input="code"
                        message={this.errorMessage}
                        value={this.code}
                        onInput={(event) => this.code = event.target.value} />

                    {when(
                        this.whisper,
                        <p class="ms-sm mt-1 text-grey-dark">Hey, Navi here. Your confirmation code is <strong>{this.whisper}</strong>!</p>
                    )}

                    <button class="button -primary mt-6 ml-auto" type="submit" disabled={this.isNotValid()}>
                        Confirm Email
                    </button>
                </form>
            </section>
        )
    },

    props: ['email'],

    data() {
        return {
            whisper: this.listenForWhispers(),
            code: null,
            errorMessage: null,
            isProcessing: false,
        }
    },

    methods: {
        isNotValid() {
            return ! this.code || this.isProcessing
        },

        listenForWhispers() {
            return when(window.App, window.App.whisper)
        },

        confirm(event) {
            event.preventDefault()

            if (this.isNotValid()) {
                return
            }

            this.isProcessing = true

            axios.post('/api/confirm-email', { code: this.code, email: this.email })
                .then(() => this.$emit('success'))
                .catch(({ response }) => {
                    console.error('erroring')
                    this.code = null
                    this.errorMessage = response.data.message
                    this.isProcessing = false
                })
        },
    },
}

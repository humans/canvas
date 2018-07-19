import axios from 'axios'

export default {
    name: 'ConfirmEmailStep',

    render(h) {
        return <section class="step confirm-email">
            <form action="/api/confirm-email" class="flex flex-col" ref="form" onSubmit={ this.confirm }>
                <div class="field">
                    <label for="code" class="field-label [ block mb-1 font-semibold ]"></label>

                    <input id="code" class="field-input [ w-full py-2 px-1 border-rounded ]" type="text"
                        onInput={ (event) => this.code = event.target.value } />

                    { this.errorMessage(h) }
                </div>

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
            error: null,
            isProcessing: false,
        }
    },

    methods: {
        errorMessage(h) {
            if (! this.error) {
                return null
            }

            return <p class="field-message">{ this.error }</p>
        },

        confirm(event) {
            event.preventDefault()

            if (! this.isValid) {
                return
            }

            this.isProcessing = true

            axios.post(this.$refs.form.action, { code: this.code, email: this.email })
                .then(() => this.$emit('success'))
                .catch(({ response }) => {
                    this.error = response.data.message
                    this.isProcessing = false
                })
        },
    },
}
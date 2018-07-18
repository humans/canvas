import axios from 'axios'

export default {
    render(h) {
        return <section class="step confirm-email">
            <form action="/api/confirm-email" class="flex flex-col" ref="form" onSubmit={ this.confirm }>
                <button class="button button-primary [ mt-6 ml-auto ]" type="submit" disabled={ this.isProcessing }>
                    Confirm Email
                </button>
            </form>
        </section>
    },

    props: ['email'],

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

            this.isProcessing = true

            axios.post(this.$refs.form.action, { code: this.code, email: this.email })
                .then(() => {
                    this.$emit('success')
                })
                .catch(({ response }) => {
                    this.errorMessage = response.data.message
                    this.isProcessing = false
                })
        },
    },
}
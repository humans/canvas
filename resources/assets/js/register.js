import axios from 'axios'
import Vue from 'vue'

Vue.component('register-form', {
    props: ['email'],

    data () {
        return {
            code:       null,
            processing: false,
            confirmed:  false,
            error:      null,
        }
    },

    methods: {
        confirm() {
            const url = this.$refs['confirm-email'].action

            this.processing = true

            axios.post(url, { code: this.code, email: this.email })
                .then(response => this.confirmed = true)
                .catch(({ response }) => {
                    this.error      = response.data.message
                    this.processing = false
                })
        },
    },
})

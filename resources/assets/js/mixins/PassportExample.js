export default {

    data: {
        user: {}
    },

    mounted() {
        if (! window.App.hasSession) {
            return
        }

        this.refreshUser()
    },

    methods: {
        refreshUser() {
            axios.get('/api/me')
                 .then(({ data: user }) => this.user = user)
        },
    },

}

export default {
    name: "TextField",

    render(h) {
        return <div class="field">
            <label for="code" class="field-label [ block mb-1 font-semibold ]">
                { this.label }
            </label>

            <input id="code" class="field-input [ w-full py-2 px-1 border border-rounded ]" type="text"
                onInput={ (event) => this.$emit('input', event) } />

            { this.messageTag(h) }
        </div>
    },

    props: ['label', 'message'],

    methods: {
        messageTag(h) {
            if (! this.message) {
                return null
            }

            return <p class="field-message">{ this.message }</p>
        },
    },
}
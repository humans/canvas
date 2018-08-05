import { renderIf } from '../helpers.js'

export default {
    name: "TextField",

    render(h) {
        return (
            <div class="field">
                <label for="code" class="label">
                    {this.label}
                </label>

                <input id="code" class="input" type="text"
                    onInput={(event) => this.$emit('input', event)} />

                {renderIf(
                    this.message,
                    <p class="message">{this.message}</p>
                )}
            </div>
        )
    },

    props: ['label', 'message'],
}

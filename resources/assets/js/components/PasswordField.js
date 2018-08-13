import Field from './Field.js'
import { when } from '../helpers.js'

export default {
    name: "PasswordField",
    mixins: [ Field ],

    render(h) {
        return (
            <div class="field">
                <label for="code" class="label">{this.label}</label>

                <input class="input" type="password"
                    id={this.input} name={this.input}
                    placeholder={this.placeholder}
                    onInput={(event) => this.$emit('input', event)} />

                {when(
                    this.message,
                    <p class="message">{this.message}</p>
                )}
            </div>
        )
    },
}

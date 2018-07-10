import expect from 'expect'
import { tap } from '../../resources/assets/js/helpers.js'

describe('tap', () => {

    it.only ('returns the original object after calling a void function', () => {
        const object = {
            originalValue: 5,
            doSomething:   () => {}
        }

        expect(
            tap(object).doSomething().originalValue
        ).toBe(5)
    })

})

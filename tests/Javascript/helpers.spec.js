import expect from 'expect'
import { when, tap } from '../../resources/assets/js/helpers.js'

describe('tap', () => {

    it('returns the original object after calling a void function', () => {
        const object = {
            originalValue: 5,
            doSomething:   () => {}
        }

        expect(
            tap(object).doSomething().originalValue
        ).toBe(5)
    })

})

describe('when', () => {

    it('returns nothing when the conditional is not met', () => {
        expect(when(false, 'no')).toBe(null)
    })

    it('returns the second parameter when the condition is met', () => {
        expect(when(true, 'yes')).toBe('yes')
    })

})

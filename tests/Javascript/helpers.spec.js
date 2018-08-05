import expect from 'expect'
import { renderIf, tap } from '../../resources/assets/js/helpers.js'

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

describe('renderIf', () => {

    it('returns nothing when the conditional is not met', () => {
        expect(renderIf(false, 'no')).toBe(null)
    })

    it('returns the second parameter when the condition is met', () => {
        expect(renderIf(true, 'yes')).toBe('yes')
    })

})

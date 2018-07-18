import { mount } from '@vue/test-utils'
import expect from 'expect'
import moxios from 'moxios'
import ConfirmEmailStep from '@components/registration/ConfirmEmailStep.js'

describe('ConfirmEmailStep', () => {
    let wrapper

    beforeEach(() => {
        moxios.install()

        wrapper = mount(ConfirmEmailStep, {
            propsData: { email: 'jaggy@artisan.studio' },
        })
    })

    afterEach(() => {
        moxios.uninstall()
    })

    it('disables the button when the confirmation code is empty', () => {
        wrapper.setData({ code: null })

        expect(
            wrapper.find('button').attributes().disabled
        ).toBeTruthy()
    })

    it('does not submit the form ', () => {
        mockPassingValidation()

        wrapper.setData({ code: null })

        wrapper.find('form').trigger('submit')

        expect(wrapper.vm.isProcessing).toBe(false)
    })

    it('emits a success event when the validation passes', (done) => {
        mockPassingValidation()

        wrapper.setData({ code: 123456 })

        wrapper.find('form').trigger('submit')

        expect(wrapper.find('button').attributes().disabled).toBeTruthy()

        moxios.wait(() => {
            expect(wrapper.emitted().success).toBeTruthy()

            done()
        })
    })

    it('shows the error message when the validation fails', (done) => {
        mockFailingValidation()

        wrapper.setData({ code: 123456 })

        wrapper.find('form').trigger('submit')

        moxios.wait(() => {
            expect(wrapper.vm.errorMessage).toBe('The confirmation code was incorrect.')

            expect(wrapper.find('button').attributes().disabled).toBeFalsy()

            done()
        })
    })

    function mockPassingValidation() {
        moxios.stubRequest('/api/confirm-email', {
            response: { 'message': 'Your email address has been confirmed.' },
            status: 200,
        })
    }

    function mockFailingValidation() {
        moxios.stubRequest('/api/confirm-email', {
            response: { 'message': 'The confirmation code was incorrect.' },
            status: 422,
        })
    }

})
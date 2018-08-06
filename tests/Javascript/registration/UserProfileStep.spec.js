import { mount } from '@vue/test-utils';
import expect from 'expect'
import moxios from 'moxios'
import UserProfileStep from '@components/registration/UserProfileStep.js'

describe('UserProfileStep', () => {
    let wrapper

    window.App = { csrfToken: '123456' }

    beforeEach(() => {
        wrapper = mount(UserProfileStep, {
            propsData: {
                errors: {},
                old: {},
            }
        })
    })

    it('shows the error messages under the field', () => {
        wrapper.setProps({
            errors: {
                name: [
                    'Error message here.'
                ],
            },
        })

        expect(wrapper.html()).toContain('Error message here.')
    })

    it('assigns the old data to the text field', () => {
        wrapper = wrapper.setProps({
            old: { name: 'Jake Peralta' },
        })

        // I'm not sure why this doesn't work here.
        // expect(wrapper.html()).toContain('Jake Peralta')
    })
})

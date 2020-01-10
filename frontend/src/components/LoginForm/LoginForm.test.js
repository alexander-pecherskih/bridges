import React from 'react'
import { shallow, mount } from 'enzyme'

import LoginForm from './LoginForm'

const defaultProps = {
    setUsername: jest.fn,
    setPassword: jest.fn,
    login: () => {  },
}

describe('<LoginForm />', () => {

    describe('LoginForm initial', () => {
        const wrapper = shallow(<LoginForm { ...defaultProps } />)

        it('render initial', () => {
            expect(wrapper.find('form')).toHaveLength(1)
        })

        it('submit is disabled', () => {
            expect(wrapper.find('button').props().disabled).toBeTruthy()
        })
    })

    describe('LoginForm login', () => {
        const wrapper = shallow(<LoginForm { ...defaultProps } username="John" password="secret" />)

        it('submit is enabled when username and password', () => {
            expect(wrapper.find('button').props().disabled).toBeFalsy()
        })
    })

    describe('LoginForm login', () => {
        const loginClick = jest.fn()
        const wrapper = mount(<LoginForm
            { ...defaultProps }
            username="John"
            password="secret"
            login={ loginClick }
        />)

        it('login clicked', () => {
            wrapper.find('button').simulate('click')
            expect(loginClick).toHaveBeenCalledTimes(1)

            expect(wrapper.find('button').prop('disabled')).toBeFalsy()
            wrapper.setProps({ loading: true })
            expect(wrapper.find('button').prop('disabled')).toBeTruthy()
        })
    })
})

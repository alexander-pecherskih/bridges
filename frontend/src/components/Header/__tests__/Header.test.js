import React from 'react'
import { shallow } from 'enzyme'

import Header from '../Header'

jest.mock('react', () => ({
    ...jest.requireActual('react'),
    useEffect: (effect) => { effect() }
}))

jest.mock('react-router', () => ({
    ...jest.requireActual('react-router'),
    useLocation: () => ({
        pathname: '/example/path'
    })
}));

describe('<Header />', () => {
    const logoutFn = jest.fn()

    const wrapper = shallow(<Header logout={ logoutFn } />)

    it('Document title is set', () => {
        expect(document.title).toEqual('The Bridge')
    })

    it('Header logout click', () => {
        wrapper.find('.logout-button').simulate('click')
        expect(logoutFn).toHaveBeenCalledTimes(1)
    })
})
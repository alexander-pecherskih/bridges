import React from 'react'
import { shallow } from 'enzyme'

import App from './App'

const defaultProps = {
    identity: null
}

describe('<App />', () => {
    const wrapper = shallow(<App { ...defaultProps } />)

    it('App Have a Header', () => {
        expect(wrapper.find('Header')).toHaveLength(1)
    })
    it('App Have a Sidebar', () => {
        expect(wrapper.find('Header')).toHaveLength(1)
    })
    it('App Have a Footer', () => {
        expect(wrapper.find('Header')).toHaveLength(1)
    })
})
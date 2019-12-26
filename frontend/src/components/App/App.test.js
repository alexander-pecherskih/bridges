import React from 'react'
import { shallow } from 'enzyme'

import App from './App'

const defaultProps = {
    identity: null
}

describe('<App />', () => {
    const wrapper = shallow(<App { ...defaultProps } />)

    it('App Have a LoginPage', () => {
        expect(wrapper.find('LoginPage')).toHaveLength(1)
    })
})
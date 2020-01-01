import React from 'react'
import { shallow } from 'enzyme'

import Footer from './Footer'

describe('<Footer />', () => {
    const wrapper = shallow(<Footer />)

    it('renders properly', () => {
        expect(wrapper).toMatchSnapshot()
    })
})
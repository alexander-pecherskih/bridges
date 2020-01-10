import React from 'react'
import { shallow } from 'enzyme'

import Sidebar from './Sidebar'

const defaultProps = {
    identity: {
        user: 'John',
    }
}

describe('<Sidebar />', () => {
    const wrapper = shallow(<Sidebar { ...defaultProps } />)

    it('Sidebar Have a User Name', () => {
        expect(wrapper.find('.user-view .name').text()).toBe(defaultProps.identity.user)
    })
})
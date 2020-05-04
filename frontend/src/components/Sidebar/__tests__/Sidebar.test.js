import React from 'react'
import { shallow } from 'enzyme'

import Sidebar from '../Sidebar'

describe('<Sidebar />', () => {
  const wrapper = shallow(<Sidebar />)

  it('renders properly', () => {
    expect(wrapper).toMatchSnapshot()
  })
})

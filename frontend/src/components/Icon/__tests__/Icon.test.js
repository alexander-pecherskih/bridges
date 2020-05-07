import React from 'react'
import { shallow } from 'enzyme'

import Icon from '../Icon'

describe('<Toolbar />', () => {
  const wrapper = shallow(<Icon icon="cloud" />)

  it('Toolbal have a button', () => {
    expect(wrapper.find('i').length).toBe(1)
  })
})

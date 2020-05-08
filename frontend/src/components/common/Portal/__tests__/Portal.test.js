import React from 'react'
import { shallow } from 'enzyme'

import Portal from '../Portal'

describe('<Portal />', () => {
  const wrapper = shallow(
    <Portal>
      <div>Portal content</div>
    </Portal>
  )

  it('Renders children', () => {
    expect(wrapper.find('div').text()).toEqual('Portal content')
  })
})

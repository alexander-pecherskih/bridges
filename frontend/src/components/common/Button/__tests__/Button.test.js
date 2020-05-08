import React from 'react'
import { shallow } from 'enzyme'

import Button from '../Button'

describe('<Button />', () => {
  const onClick = jest.fn()
  const wrapper = shallow(<Button title="CLICK ME" onClick={onClick} />)

  it('Renders title', () => {
    expect(wrapper.find('button').text()).toEqual('CLICK ME')
  })

  it('Handle click', () => {
    wrapper.find('button').simulate('click')
    expect(onClick).toHaveBeenCalledTimes(1)
  })
})

import React from 'react'
import { shallow } from 'enzyme'

import Toolbar from '../Toolbar'

const buttons = [
  {
    label: 'button 1',
    handler: jest.fn()
  },
  {
    label: 'button disabled',
    handler: jest.fn(),
    disabled: true
  },
  {
    label: 'button with icon',
    handler: jest.fn(),
    icon: 'cloud'
  }
]

describe('<Toolbar />', () => {
  const wrapper = shallow(<Toolbar buttons={ buttons } />)

  it('Toolbal have a button', () => {
    expect(wrapper.find('button').at(0).text()).toBe(buttons[0].label)
  })

  it('Toolbal have a disabled button', () => {
    expect(wrapper.find('button').at(1).prop('disabled')).toBeTruthy()
  })

  it('Toolbal have a button with icon', () => {
    expect(wrapper.find('button > Icon').length).toBe(1)
  })

  it('Toolbal handler executed', () => {
    wrapper.find('button').at(0).simulate('click')
    expect(buttons[0].handler).toHaveBeenCalledTimes(1)
  })
})

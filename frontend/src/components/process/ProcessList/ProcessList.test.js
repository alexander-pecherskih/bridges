import React from 'react'
import { shallow } from 'enzyme'

import ProcessList from './ProcessList'

const processes = [
  {
    id: '1',
    title: 'process 1',
  },
  {
    id: '2',
    title: 'process 2',
  },
]

describe('<ProcessList />', () => {
  describe('ProcessList initial', () => {
    const wrapper = shallow(
      <ProcessList processes={processes} loading={false} />
    )

    it('ProcessList Have a Rows', () => {
      expect(wrapper.find('table tbody ProcessRow')).toHaveLength(2)
    })
  })

  describe('ProcessList loading', () => {
    const wrapper = shallow(
      <ProcessList processes={processes} loading={true} />
    )

    it('ProcessList Have a Loading message', () => {
      expect(wrapper.find('TBodyMessage')).toHaveLength(1)
    })
  })

  describe('ProcessList is empty', () => {
    const wrapper = shallow(<ProcessList processes={[]} loading={false} />)

    it('ProcessList Have a Nothing Found message', () => {
      expect(wrapper.find('TBodyMessage')).toHaveLength(1)
    })
  })
})

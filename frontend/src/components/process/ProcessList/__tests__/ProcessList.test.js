import React from 'react'
import { shallow } from 'enzyme'

import ProcessList from '../ProcessList'

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
  it('ProcessList initial', () => {
    const wrapper = shallow(
      <ProcessList processes={processes} loading={false} errorMessage={null}/>
    )

    expect(wrapper).toMatchSnapshot();
  })

  it('ProcessList loading', () => {
    const wrapper = shallow(
      <ProcessList processes={processes} loading={true} />
    )

    expect(wrapper).toMatchSnapshot();
  })

  it('ProcessList is empty', () => {
    const wrapper = shallow(<ProcessList processes={[]} loading={false} />)

    expect(wrapper).toMatchSnapshot();
  })
})

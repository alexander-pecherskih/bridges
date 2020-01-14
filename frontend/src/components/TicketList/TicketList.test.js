import React from 'react'
import { shallow } from 'enzyme'

import TicketList from './TicketList'

const tickets = [
    {
        id: '1',
        title: 'ticket 1',
    },
    {
        id: '2',
        title: 'ticket 2',
    }
]

describe('<TicketList />', () => {
    const wrapper = shallow(<TicketList tickets={ tickets } />)

    it('Ticket List Have a Rows', () => {
        expect(wrapper.find('table tbody TicketRow')).toHaveLength(2)
    })
})
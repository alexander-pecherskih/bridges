import React from 'react'
import { shallow } from 'enzyme'

import TicketList from './TicketList'
import ProcessList from '../process/ProcessList/ProcessList'

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

    describe('TicketList initial', () => {
        const wrapper = shallow(<TicketList tickets={ tickets } loading={ false } />)

        it('Ticket List Have a Rows', () => {
            expect(wrapper.find('table tbody TicketRow')).toHaveLength(2)
        })
    })

    describe('TicketList loading', () => {
        const wrapper = shallow(<TicketList tickets={ tickets } loading={ true } />)

        it('Ticket List Have a Loading message', () => {
            expect(wrapper.find('TBodyMessage')).toHaveLength(1)
        })
    })

    describe('TicketList is empty', () => {
        const wrapper = shallow(<TicketList tickets={ [] } loading={ false } />)

        it('TicketList Have a Nothing Found message', () => {
            expect(wrapper.find('TBodyMessage')).toHaveLength(1)
        })
    })

})
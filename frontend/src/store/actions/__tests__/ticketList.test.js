import configureMockStore from 'redux-mock-store'
import thunk from 'redux-thunk'

import * as actions from '../ticketList'
import { TICKET_LIST_REQUEST, TICKET_LIST_SUCCESS, TICKET_LIST_FAILURE } from '../../constants/ticketList'

import { defaultTicketList } from '../../../services/__mocks__/TicketService'

import TicketService from '../../../services/TicketService'
jest.mock('../../../services/TicketService')

const mockStore = configureMockStore([thunk])

describe('ticket list get action', () => {
  it('success', () => {
    const store = mockStore({ })
    const expectedActions = [
      { type: TICKET_LIST_REQUEST },
      {
        type: TICKET_LIST_SUCCESS,
        tickets: defaultTicketList
      }
    ]

    return store.dispatch(actions.getTickets())
      .then(() => {
        expect(store.getActions()).toMatchObject(expectedActions)
      })
  })

  it('failure', () => {
    const store = mockStore({ })
    const expectedActions = [
      { type: TICKET_LIST_REQUEST },
      {
        type: TICKET_LIST_FAILURE,
        error: { message: 'error' }
      }
    ]

    TicketService.getTickets = jest.fn(
      /* eslint-disable-next-line */
      () => Promise.reject({ message: 'error' })
    )

    return store.dispatch(actions.getTickets())
      .then(() => {
        expect(store.getActions()).toEqual(expectedActions)
      })
  })
})

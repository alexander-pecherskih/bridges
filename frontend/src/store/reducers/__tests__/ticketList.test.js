import { TICKET_LIST_REQUEST, TICKET_LIST_LOADED, TICKET_LIST_FAILURE } from '../../constants/ticketList'
import { default as reducer, initialState } from '../ticketList'

describe('ticket list reducer', () => {
    it(TICKET_LIST_REQUEST, () => {
        const action = {
            type: TICKET_LIST_REQUEST,
        }
        expect(reducer(initialState, action)).toEqual({
            ...initialState,
            loading: true,
            tickets: [],
        })
    })

    it(TICKET_LIST_LOADED, () => {
        const stateBefore = {
            ...initialState,
            loading: true,
        }
        const action = {
            type: TICKET_LIST_LOADED,
            tickets: [1, 2, 3]
        }
        expect(reducer(stateBefore, action)).toEqual({
            ...stateBefore,
            loading: false,
            tickets: action.tickets,
        })
    })

    it(TICKET_LIST_FAILURE, () => {
        const stateBefore = {
            ...initialState,
            loading: true,
        }
        const action = {
            type: TICKET_LIST_FAILURE,
            error: {}
        }
        expect(reducer(stateBefore, action)).toEqual({
            ...stateBefore,
            loading: false,
            tickets: [],
            error: action.error
        })
    })


    it('default action', () => {
        expect(reducer(initialState, { type: 'undefined' })).toEqual(initialState)
    })
})
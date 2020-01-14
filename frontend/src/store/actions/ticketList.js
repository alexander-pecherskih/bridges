import { TICKET_LIST_REQUEST, TICKET_LIST_LOADED, TICKET_LIST_FAILURE } from '../constants/ticketList'
import TicketService from '../../services/TicketService'

const request = {
    type: TICKET_LIST_REQUEST,
}

const loaded = (tickets) => {
    return {
        type: TICKET_LIST_LOADED,
        payload: tickets,
    }
}

const fail = (error) => {
    return {
        type: TICKET_LIST_FAILURE,
        payload: error,
    }
}

const getTickets = (dispatch) => () => {
    dispatch(request)

    TicketService.getTickets()
        .then((tickets) => {
            dispatch( loaded(tickets) )
        })
        .catch((err) => {
            dispatch( fail(err.message) )
        })
}

export { getTickets }
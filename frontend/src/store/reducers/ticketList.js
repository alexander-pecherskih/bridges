import { TICKET_LIST_REQUEST, TICKET_LIST_LOADED, TICKET_LIST_FAILURE } from '../constants/ticketList'

const initialState = {
    tickets: [],
    loading: true,
    error: null,
}

const ticketList = (state = initialState, action) => {
    switch (action.type) {
        case TICKET_LIST_REQUEST:
            return {
                tickets: [],
                loading: true,
                error: null,
            }
        case TICKET_LIST_LOADED:
            return {
                tickets: action.payload,
                loading: false,
                error: null,
            }
        case TICKET_LIST_FAILURE:
            return {
                tickets: [],
                loading: false,
                error: action.payload,
            }
        default:
            return state
    }
}

export default ticketList
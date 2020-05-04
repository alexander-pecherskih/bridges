import { TICKET_LIST_REQUEST, TICKET_LIST_SUCCESS, TICKET_LIST_FAILURE } from '../constants/ticketList'
import TicketService from '../../services/TicketService'

const request = {
  type: TICKET_LIST_REQUEST
}

const success = (tickets) => {
  return {
    type: TICKET_LIST_SUCCESS,
    tickets
  }
}

const fail = (error) => {
  return {
    type: TICKET_LIST_FAILURE,
    error
  }
}

const getTickets = () => (dispatch) => {
  dispatch(request)

  return TicketService.getTickets()
    .then((tickets) => {
      dispatch(success(tickets))
    })
    .catch((error) => {
      dispatch(fail(error))
    })
}

export { getTickets }

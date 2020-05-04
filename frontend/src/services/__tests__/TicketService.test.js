import TicketService from '../TicketService'

describe('TicketService', () => {
  it('fetch all', () => {
    return TicketService.getTickets()
      .then(data => {
        expect(data.length > 0).toBeTruthy()
      })
  })
})

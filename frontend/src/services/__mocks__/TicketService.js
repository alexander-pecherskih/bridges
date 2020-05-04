export const defaultTicketList = [
  {
    id: '1',
    title: 'Ticket 1'
  },
  {
    id: '2',
    title: 'Ticket 2'
  }
]

export default {
  getTickets: () => Promise.resolve(defaultTicketList)
}

export default class TicketService {
    static defaultTicketList = [
      {
        id: '1',
        title: 'Ticket 1'
      },
      {
        id: '2',
        title: 'Ticket 2'
      }
    ]

    static getTickets() {
      return new Promise((resolve) => {
        setTimeout(() => {
          resolve(this.defaultTicketList)
        }, 1000)
      })
    }
}

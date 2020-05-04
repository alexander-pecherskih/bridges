import React from 'react'
import PropTypes from 'prop-types'

import TBodyMessage from '../common/TBodyMessage'

const TicketRow = ({ ticket }) => {
  return <tr>
    <td>{ ticket.id }</td>
    <td>{ ticket.title }</td>
  </tr>
}

TicketRow.propTypes = {
  ticket: PropTypes.object
}

const TicketList = ({ tickets, loading, errorMessage }) => {
  let rows = tickets.map((item) => {
    return <TicketRow ticket={ item } key={ item.id }/>
  })

  if (loading) {
    rows = <TBodyMessage colSpan={ 2 } message="Loading..." />
  } else if (rows.length === 0) {
    rows = <TBodyMessage colSpan={ 2 } message="No one Ticket Found" />
  }

  if (errorMessage) {
    rows = <TBodyMessage colSpan={ 2 } message={ errorMessage } />
  }

  return <table>
    <thead>
      <tr>
        <th>id</th>
        <th>title</th>
      </tr>
    </thead>
    <tbody>
      { rows }
    </tbody>
  </table>
}

TicketList.propTypes = {
  tickets: PropTypes.array.isRequired,
  loading: PropTypes.bool.isRequired,
  errorMessage: PropTypes.string
}

export default TicketList

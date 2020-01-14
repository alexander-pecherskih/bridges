import React from 'react'
import PropTypes from 'prop-types'

const TicketRow = ({ ticket }) => {
    return <tr>
        <td>{ ticket.id }</td>
        <td>{ ticket.title }</td>
    </tr>
}

TicketRow.propTypes = {
    ticket: PropTypes.object,
}

const LoadIndicator = () => {
    return <tr>
        <td colSpan="2">Loading...</td>
    </tr>
}

const TicketList = ({ tickets, loading, errorMessage }) => {
    const rows = tickets.map((item) => {
        return <TicketRow ticket={ item } key={ item.id }/>
    })

    return <table>
        <thead>
            <tr>
                <th>id</th>
                <th>title</th>
            </tr>
        </thead>
        <tbody>
            { !loading && rows.length > 0 ? rows : <LoadIndicator /> }
            { errorMessage ? <div>{ errorMessage }</div> : null }
        </tbody>
    </table>
}

TicketList.propTypes = {
    tickets: PropTypes.array.isRequired,
    loading: PropTypes.bool.isRequired,
    errorMessage: PropTypes.string,
}

export default TicketList
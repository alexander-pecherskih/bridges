import React, {useEffect} from 'react'
import PropTypes from 'prop-types'
import { compose } from 'redux'
import { connect } from 'react-redux'

import { getTickets } from '../../store/actions/ticketList'
import TicketList from './TicketList'

const TicketListContainer = ({ tickets, loading, error, getTickets }) => {
    const onMount = () => { getTickets() }
    useEffect(onMount, [])

    return <TicketList tickets={ tickets } loading={ loading } errorMessage={ error }/>
}

TicketListContainer.propTypes = {
    tickets: PropTypes.array.isRequired,
    loading: PropTypes.bool.isRequired,
    error: PropTypes.object,
    getTickets: PropTypes.func.isRequired,
}

const mapStateToProps = ({ ticketList: { tickets, loading, error } }) => {
    return { tickets, loading, error }
}

const mapDispatchToProps = (dispatch) => {
    return {
        getTickets: () => dispatch(getTickets()),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatchToProps)
)(TicketListContainer)
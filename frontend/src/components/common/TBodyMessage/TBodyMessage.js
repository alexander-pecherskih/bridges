import React from 'react'
import PropTypes from 'prop-types'

const TBodyMessage = ({ colSpan, message }) => {
    return <tr>
        <td colSpan={ colSpan }>{ message }</td>
    </tr>
}

TBodyMessage.propTypes = {
    colSpan: PropTypes.number.isRequired,
    message: PropTypes.string.isRequired,
}

export default TBodyMessage
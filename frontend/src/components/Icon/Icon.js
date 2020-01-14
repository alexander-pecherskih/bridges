import React from 'react'
import PropTypes from 'prop-types'

const Icon = ({ icon }) => {
    return <i className="material-icons">{ icon }</i>
}

Icon.propTypes = {
    icon: PropTypes.string.isRequired,
}

export default Icon
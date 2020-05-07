import React from 'react'
import PropTypes from 'prop-types'

const Icon = ({ icon, className = '' }) => {
  return <i className={`material-icons ${className}`}>{icon}</i>
}

Icon.propTypes = {
  icon: PropTypes.string.isRequired,
  className: PropTypes.string,
}

export default Icon

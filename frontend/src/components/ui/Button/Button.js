import React from 'react'
import PropTypes from 'prop-types'
import styles from './styles/Button.module.css'

const Button = ({ caption, click, disabled = false }) => {
  return (
    <button
      className={styles.button}
      onClick={click}
      disabled={disabled}
    >{caption}</button>
  )
}

Button.propTypes = {
  caption: PropTypes.string.isRequired,
  click: PropTypes.func.isRequired,
  disabled: PropTypes.bool
}

export default Button
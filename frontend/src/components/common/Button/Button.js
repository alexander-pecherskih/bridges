import React from 'react'
import PropTypes from 'prop-types'

import styles from './styles/Button.module.scss'

const Button = (props) => {
  const { title, onClick, ...other } = props

  return (
    <button
      onClick={onClick}
      {...other}
      className={styles.button}
      type="button"
    >
      {title}
    </button>
  )
}

Button.propTypes = {
  title: PropTypes.string,
  onClick: PropTypes.func,
}

Button.defaultProps = {
  title: '',
  onClick: () => {},
}

export default Button

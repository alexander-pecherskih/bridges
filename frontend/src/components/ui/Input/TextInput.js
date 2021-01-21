import React from 'react'
import PropTypes from 'prop-types'

import styles from './styles/TextInput.module.css'

const TextInput = ({ name, label, placeholder, change, type = 'text' }) => {
  return (
    <div className={styles.textInput}>
      <label htmlFor={name}>{label}
        <input
          type={type}
          name={name}
          id={name}
          placeholder={placeholder}
          onChange={change}
        />
      </label>
    </div>
  )
}

TextInput.propTypes = {
  name: PropTypes.string.isRequired,
  label: PropTypes.string,
  placeholder: PropTypes.string,
  change: PropTypes.func,
  type: PropTypes.oneOf(['text', 'password'])
}

export default TextInput

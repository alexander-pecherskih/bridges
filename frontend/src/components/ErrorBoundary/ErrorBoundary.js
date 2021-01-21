import React from 'react'
import PropTypes from 'prop-types'

import styles from './styles/ErrorBoundary.module.css'

export default class ErrorBoundary extends React.Component {
  state = {
    hasError: false,
  }

  static getDerivedStateFromError(error) {
    return {
      hasError: true,
      error,
    }
  }

  render() {
    if (this.state.hasError) {
      console.log(this.state.error)
      return (
        <div className={styles.ErrorBox}>
          <div className={styles.Title}>Что-то пошло не так :(</div>
          <div className={styles.Message}>{this.state.error.toString()}</div>
        </div>
      )
    }

    return this.props.children
  }
}

ErrorBoundary.propTypes = {
  children: PropTypes.element,
}

import React from 'react'
import PropTypes from 'prop-types'

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
      return <div>Что-то пошло не так :(</div>
    }

    return this.props.children
  }
}

ErrorBoundary.propTypes = {
  children: PropTypes.element,
}

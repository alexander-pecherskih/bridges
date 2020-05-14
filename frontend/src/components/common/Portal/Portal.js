import React from 'react'
import PropTypes from 'prop-types'
import ReactDOM from 'react-dom'

class Portal extends React.Component {
  el = document.createElement('div')

  componentDidMount() {
    document.body.appendChild(this.el)
  }

  componentWillUnmount() {
    document.body.removeChild(this.el)
  }

  render() {
    return ReactDOM.createPortal(this.props.children, this.el)
  }
}

Portal.propTypes = {
  children: PropTypes.node,
}

Portal.defaultProps = {
  children: null,
}

export default Portal

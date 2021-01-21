import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import { bindActionCreators, compose } from 'redux'
import { connect } from 'react-redux'
import App from './App'
import { withApi } from '../../packages/api'
import { restoreAuth } from '../../store/actions/auth'
import Spinner from '../ui/Spinner/Spinner'

const AppContainer = ({ restoreAuth, loading }) => {
  useEffect(restoreAuth, [])

  if (loading) {
    return <Spinner />
  }

  return <App />
}

AppContainer.propTypes = {
  restoreAuth: PropTypes.func.isRequired,
  loading: PropTypes.bool.isRequired,
}

const mapStateToProps = ({ auth: { loading } }) => {
  return { loading }
}

const mapDispatchToProps = (dispatch, { api }) => {
  return bindActionCreators({
    restoreAuth: restoreAuth(api),
  }, dispatch)
}

export default compose(
  withApi(),
  connect(mapStateToProps, mapDispatchToProps)
)(AppContainer)

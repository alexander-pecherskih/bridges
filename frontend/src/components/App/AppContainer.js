import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import { bindActionCreators, compose } from 'redux'
import { connect } from 'react-redux'
import App from './App'
import { withApi } from '../../packages/api'
import { LoginPage } from '../pages'
import { logout, restoreAuth } from '../../store/actions/auth'
import { useHistory, useLocation } from 'react-router'

const AppContainer = ({ authorized, restoreAuth, logout, loading }) => {
  useEffect(restoreAuth, [])
  const location = useLocation()
  const history = useHistory()

  if (location.pathname.match(/\/logout|\/login/)) {
    logout()
    history.push('/')
  }

  if (!authorized && !loading) {
    return <LoginPage />
  }

  return <App />
}

AppContainer.propTypes = {
  authorized: PropTypes.bool.isRequired,
  restoreAuth: PropTypes.func.isRequired,
}

const mapStateToProps = ({ auth: { authorized, loading } }) => {
  return { authorized, loading }
}

const mapDispatchToProps = (dispatch, { api }) => {
  return bindActionCreators({
    restoreAuth: restoreAuth(api),
    logout: logout(api)
  }, dispatch)
}

export default compose(
  withApi(),
  connect(mapStateToProps, mapDispatchToProps)
)(AppContainer)

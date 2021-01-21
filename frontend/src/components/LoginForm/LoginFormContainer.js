import React from 'react'
import PropTypes from 'prop-types'
import LoginForm from './LoginForm'
import { bindActionCreators, compose } from 'redux'
import { withApi } from '../../packages/api'
import { connect } from 'react-redux'
import { login, logout } from '../../store/actions/auth'
import { Redirect } from 'react-router'

const LoginFormContainer = ({ authorized, loading, error, login }) => {
  if (authorized) {
    return <Redirect to={{ pathname: '/' }} />
  }

  return <LoginForm enabled={!loading} errorMessage={error} login={login} />
}

LoginFormContainer.propTypes = {
  authorized: PropTypes.bool.isRequired,
  loading: PropTypes.bool,
  error: PropTypes.string,
  login: PropTypes.func.isRequired,
}

const mapStateToProps = ({ auth: { authorized, loading, error } }) => {
  return {
    authorized,
    loading,
    error: error === null ? '' : error,
  }
}

const mapDispatchToProps = (dispatch, { api }) => {
  return bindActionCreators(
    {
      login: login(api),
      logout: logout(api),
    },
    dispatch
  )
}

export default compose(
  withApi(),
  connect(mapStateToProps, mapDispatchToProps)
)(LoginFormContainer)

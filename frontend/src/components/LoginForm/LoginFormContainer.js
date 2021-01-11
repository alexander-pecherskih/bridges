import React from 'react'
import PropTypes from 'prop-types'
import LoginForm from './LoginForm'
import { bindActionCreators, compose } from 'redux'
import { withApi } from '../../packages/api'
import { connect } from 'react-redux'
import { login } from '../../store/actions/auth'

const LoginFormContainer = ({ loading, error, login }) => {
  return (
    <LoginForm
      enabled={!loading}
      errorMessage={error}
      login={login}
    />
  )
}

LoginFormContainer.propTypes = {
  loading: PropTypes.bool,
  error: PropTypes.string,
  login: PropTypes.func.isRequired
}

const mapStateToProps = ({ auth: { loading, error } }) => {
  return {
    loading,
    error: error === null ? '' : error,
  }
}

const mapDispatchToProps = (dispatch, { api }) => {
  return bindActionCreators({
    login: login(api)
  }, dispatch)
}

export default compose(
  withApi(),
  connect(mapStateToProps, mapDispatchToProps)
)(LoginFormContainer)

import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import { bindActionCreators, compose } from 'redux'

import { logout } from '../../store/actions/auth'
import { withApi } from '../../packages/api'
import { connect } from 'react-redux'
import { Redirect } from 'react-router'

const LogoutPage = ({ logout }) => {
  useEffect(logout, [])

  return <Redirect to={{ pathname: '/login' }} />
}
LogoutPage.propTypes = {
  logout: PropTypes.func.isRequired,
}

const mapDispatchToProps = (dispatch, { api }) => {
  return bindActionCreators(
    {
      logout: logout(api),
    },
    dispatch
  )
}

export default compose(withApi(), connect(null, mapDispatchToProps))(LogoutPage)

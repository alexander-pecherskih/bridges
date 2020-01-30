import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { compose } from 'redux'
import { useLocation, withRouter } from 'react-router'

import App from './App'
import { logout, refreshAuthToken } from '../../store/actions'
import { LoginPage } from '../../pages'

const AppContainer = ({ authorized, loading, logout, refreshAuthToken }) => {
    const location = useLocation()
    useEffect(refreshAuthToken, [])

    if (!loading && (!authorized || location.pathname === '/logout')) {
        return <LoginPage />
    }
    if (loading) {
        return <>Loading...</>
    }

    return <App logout={ logout } />
}

AppContainer.propTypes = {
    authorized: PropTypes.bool,
    loading: PropTypes.bool.isRequired,
    logout: PropTypes.func.isRequired,
    refreshAuthToken: PropTypes.func.isRequired
}

const mapStateToProps = ({ auth: { accessToken, authorized, loading } }) => {
    return { accessToken, authorized, loading }
}

const mapDispatchToProps = (dispatch) => {
    return {
        logout: logout(dispatch),
        refreshAuthToken: refreshAuthToken(dispatch)
    }
}

export default compose(
    withRouter,
    connect(mapStateToProps, mapDispatchToProps)
)(AppContainer)
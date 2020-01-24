import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { compose } from 'redux'
import { useLocation, withRouter } from 'react-router'

import App from './App'
import { refreshAuthState, logout } from '../../store/actions'
import { LoginPage } from '../../pages'

const AppContainer = ({ authorized, loading, logout, refreshAuthState }) => {
    const location = useLocation()
    useEffect(refreshAuthState, [])

    if (authorized === false || location.pathname === '/logout') {
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
    refreshAuthState: PropTypes.func.isRequired,
}

const mapStateToProps = ({ auth: { authorized, loading } }) => {
    return { authorized, loading }
}

const mapDispatchToProps = (dispatch) => {
    return {
        refreshAuthState: refreshAuthState(dispatch),
        logout: logout(dispatch)
    }
}

export default compose(
    withRouter,
    connect(mapStateToProps, mapDispatchToProps)
)(AppContainer)
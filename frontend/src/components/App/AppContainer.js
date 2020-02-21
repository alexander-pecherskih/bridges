import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { compose } from 'redux'
import { useLocation, withRouter } from 'react-router'

import App from './App'
import { logout, refreshAuthToken } from '../../store/actions/auth'
import { LoginPage } from '../../pages'
import { getUrl } from '../../services/url'

const AppContainer = ({ authorized, loading, logout, refreshAuthToken }) => {
    const location = useLocation()
    // console.log(refreshAuthToken())
    useEffect(() => { refreshAuthToken() }, [refreshAuthToken])

    if (location.pathname === getUrl('/login')) {
        logout(true)
        return null
    }

    if (!loading && !authorized) {
        return <LoginPage />
    }
    if (loading) {
        return <>Loading...</>
    }

    return <App logout={ () => logout() } />
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
        logout: () => dispatch(logout()),
        refreshAuthToken: () => dispatch(refreshAuthToken())
    }
}

export default compose(
    withRouter,
    connect(mapStateToProps, mapDispatchToProps)
)(AppContainer)
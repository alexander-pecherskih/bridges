import React, { useEffect } from 'react'
import { connect } from 'react-redux'
import { compose } from 'redux'
import { withRouter } from 'react-router'

import App from './App'
import { getIdentity, logout } from '../../store/actions'
import { LoginPage } from '../../pages'

const AppContainer = ({ identity, loading, logout, getIdentity }) => {
    useEffect(getIdentity, [])

    if (identity === null || identity === undefined) {
        return <LoginPage />
    }

    if (loading) {
        return <>Loading...</>
    }

    return <App identity={ identity } logout={ logout } />
}

const mapStateToProps = ({ auth: { identity, loading } }) => {
    return { identity, loading }
}

const mapDispatchToProps = (dispatch) => {
    return {
        getIdentity: getIdentity(dispatch),
        logout: logout(dispatch)
    }
}

export default compose(
    withRouter,
    connect(mapStateToProps, mapDispatchToProps)
)(AppContainer)
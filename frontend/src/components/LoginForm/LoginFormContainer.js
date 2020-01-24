import React, {useEffect, useState} from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { compose } from 'redux'

import { auth, logout } from '../../store/actions'
import withAuthService from '../hoc/withAuthService'
import LoginForm from './LoginForm'

const LoginFormContainer = ({ auth, loading, error, logout }) => {
    const [username, setUsername] = useState('')
    const [password, setPassword] = useState('')
    useEffect(logout, [])

    return <LoginForm
        loading={ loading }
        username={ username }
        password={ password }
        setUsername={ (value) => setUsername(value) }
        setPassword={ (value) => setPassword(value) }
        login={ () => auth(username, password) }
        errorMessage={ error }
    />
}

LoginFormContainer.propTypes = {
    auth: PropTypes.func.isRequired,
    logout: PropTypes.func.isRequired,
    loading: PropTypes.bool.isRequired,
    error: PropTypes.string,
}

const mapStateToProps = ({ auth: { authorized, loading, error } }) => {
    return { authorized, loading, error }
}

const mapDispatchToProps = (dispatch, { authService }) => {
    return {
        auth: auth(dispatch, authService),
        logout: logout(dispatch)
    }
}

export default compose(
    withAuthService(),
    connect(mapStateToProps, mapDispatchToProps)
)(LoginFormContainer)
import React, { useState } from 'react'
import { connect } from 'react-redux'
import { compose } from 'redux'

import { auth } from '../../store/actions'
import withAuthService from '../hoc/withAuthService'
import LoginForm from './LoginForm'

const LoginFormContainer = ({ auth, loading }) => {
    const [username, setUsername] = useState('')
    const [password, setPassword] = useState('')

    return <LoginForm
        loading={ loading }
        username={ username }
        password={ password }
        setUsername={ (value) => setUsername(value) }
        setPassword={ (value) => setPassword(value) }
        login={ () => auth() }
    />
};

const mapStateToProps = ({ auth: { identity, loading, error } }) => {
    return { identity, loading, error }
}

const mapDispatchToProps = (dispatch, { authService }) => {
    return {
        auth: auth(dispatch, authService),
    }
}

export default compose(
    withAuthService(),
    connect(mapStateToProps, mapDispatchToProps)
)(LoginFormContainer)
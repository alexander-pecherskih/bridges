import React from 'react'

import { AuthServiceProvider } from '../components/AuthServiceContext'
import AuthService from '../services/AuthService'

import LoginFormContainer from '../components/LoginForm'

const LoginPage = () => {
    return (
        <AuthServiceProvider value={ new AuthService() }>
            <LoginFormContainer />
        </AuthServiceProvider>
    )
}

export default LoginPage
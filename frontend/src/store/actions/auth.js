import { AUTH_REQUEST, AUTH_SUCCESS, AUTH_FAILURE, LOGOUT } from '../constants/auth'

import AuthService from '../../services/AuthService'

const authorize = {
    type: AUTH_REQUEST,
}

const authorized = (accessToken) => {
    return {
        type: AUTH_SUCCESS,
        accessToken
    }
}

const authError = (error) => {
    return {
        type: AUTH_FAILURE,
        error,
    }
}

const auth = (username, password) => (dispatch) => {
    dispatch(authorize)

    return AuthService.authorize(username, password)
        .then((accessToken) => {
            dispatch(authorized(accessToken))
        })
        .catch((err) => {
            dispatch(authError(err.message))
        })
}

const refreshAuthToken = () => (dispatch) => {
    if (!AuthService.refreshTokenIsValid()) {
        dispatch({ type: LOGOUT })
        return
    }

    dispatch(authorize)

    return AuthService.refreshToken()
        .then((accessToken) => {
            dispatch(authorized(accessToken))
        })
        .catch(() => {
            dispatch({ type: LOGOUT })
        })
}

const logout = (redirectHome = false) => (dispatch) => {
    AuthService.logout()

    dispatch({ type: LOGOUT })

    if (redirectHome) {
        window.location.replace('/')
    }
}

export { auth, logout, refreshAuthToken }
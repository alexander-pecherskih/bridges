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
        payload: error,
    }
}

const auth = (dispatch) => (username, password) => {
    dispatch(authorize)

    AuthService.authorize(username, password)
        .then((accessToken) => {
            dispatch(authorized(accessToken))
        })
        .catch((err) => {
            dispatch(authError(err.message))
        })
}

const refreshAuthToken = (dispatch) => () => {
    dispatch(authorize)

    AuthService.refreshToken()
        .then((accessToken) => {
            dispatch(authorized(accessToken))
        })
        .catch(() => {
            dispatch({ type: LOGOUT })
        })
}

const logout = (dispatch) => (redirectUrl = null) => {
    AuthService.logout()
    dispatch({ type: LOGOUT })

    if (redirectUrl) {
        window.location.replace(redirectUrl)
    }
}

export { auth, logout, refreshAuthToken }
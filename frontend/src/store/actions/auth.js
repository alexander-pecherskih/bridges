import { AUTH_REQUEST, AUTH_SUCCESS, AUTH_FAILURE, LOGOUT } from '../constants/auth'

import AuthService from '../../services/AuthService'

const authorize = {
    type: AUTH_REQUEST,
}

const authorized = (identity) => {
    return {
        type: AUTH_SUCCESS,
        payload: identity,
    }
}

const authError = (error) => {
    return {
        type: AUTH_FAILURE,
        payload: error,
    }
}

const auth = (dispatch, authService = null) => (username, password) => {
    if (!authService) {

    }
    dispatch(authorize)

    authService.getIdentity(username, password)
        .then((data) => {
            dispatch(authorized(data))
        })
        .catch((err) => {
            dispatch(authError(err.message))
        })
}

const getIdentity = (dispatch) => () => {
    const identity = AuthService.getIdentityFromLocalStorage()

    dispatch(authorized(identity))
}

const logout = (dispatch) => () => {
    AuthService.removeIdentityFromLocalStorage()

    dispatch({ type: LOGOUT })
}

export { auth, getIdentity, logout }
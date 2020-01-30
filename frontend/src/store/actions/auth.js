import { AUTH_REQUEST, AUTH_SUCCESS, AUTH_FAILURE, LOGOUT } from '../constants/auth'

import AuthService from '../../services/AuthService'

const authorize = {
    type: AUTH_REQUEST,
}

const authorized = {
    type: AUTH_SUCCESS,
}

const authError = (error) => {
    return {
        type: AUTH_FAILURE,
        payload: error,
    }
}

const auth = (dispatch, authService = null) => (username, password) => {
    dispatch(authorize)

    authService.getToken(username, password)
        .then(() => {
            dispatch(authorized, true)
        })
        .catch((err) => {
            dispatch(authError(err.message))
        })
}

const refreshAuthState = (dispatch) => () => {
    if (!AuthService.getTokenFromLocalStorage()) {
        dispatch({ type: LOGOUT })
        return
    }
    dispatch(authorized)
}

const logout = (dispatch) => () => {
    AuthService.removeTokensFromLocalStorage()

    dispatch({ type: LOGOUT })
}

export { auth, refreshAuthState, logout }
import AuthService from '../../services/AuthService'

const authorize = () => {
    return {
        type: 'AUTH_REQUEST',
    }
}

const authorized = (identity) => {
    return {
        type: 'AUTH_SUCCESS',
        payload: identity,
    }
}

const authError = (error) => {
    return {
        type: 'AUTH_FAILURE',
        payload: error,
    }
}

const auth = (dispatch, authService = null) => () => {
    if (!authService) {

    }
    dispatch(authorize())

    authService.getIdentity()
        .then((data) => dispatch(authorized(data)))
        .catch((err) => dispatch(authError(err)))
}

const getIdentity = (dispatch) => () => {
    const identity = AuthService.getIdentityFromLocalStorage()

    dispatch(authorized(identity))
}

const logout = (dispatch) => () => {
    AuthService.removeIdentityFromLocalStorage()

    dispatch({ type: 'LOGOUT' })
}

export { auth, getIdentity, logout };
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

const auth = (authService, dispatch) => () => {
    dispatch(authorize())

    authService.getIdentity()
        .then((data) => dispatch(authorized(data)))
        .catch((err) => dispatch(authError(err)))
}

export default auth;
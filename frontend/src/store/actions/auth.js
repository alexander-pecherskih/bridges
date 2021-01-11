import {
  AUTH_REQUEST,
  AUTH_SUCCESS,
  AUTH_FAILURE, RESTORE_AUTH, LOGOUT
} from '../constants/auth'

export const login = (api) => (username, password) => (dispatch) => {
  dispatch({
    type: AUTH_REQUEST,
  })

  api.authorization
    .login(username, password)
    .then(({ accessToken, refreshToken }) => {
      dispatch({
        type: AUTH_SUCCESS,
        accessToken,
      })
      // window.location.replace('/')
    })
    .catch((err) => {
      dispatch({
        type: AUTH_FAILURE,
        error: err.message,
      })
    })
}

export const restoreAuth = (api) => () => (dispatch) => {
  if (!api.token.get('access_token')) {
    dispatch({
      type: LOGOUT,
    })
    return
  }
  dispatch({
    type: RESTORE_AUTH,
  })
}

export const logout = (api) => (redirect) => (dispatch) => {
  api.authorization.logout()
  dispatch({
    type: LOGOUT,
  })
  if (typeof redirect === 'function') {
    redirect()
  }
  // window.location.replace('/')
}

// const refreshAuthToken = (api) => () => (dispatch) => {
//   if (!AuthService.refreshTokenIsValid()) {
//     dispatch({ type: LOGOUT })
//     return
//   }
//
//   dispatch(authorize)
//
//   return AuthService.refreshToken()
//     .then((accessToken) => {
//       dispatch(authorized(accessToken))
//     })
//     .catch(() => {
//       dispatch({ type: LOGOUT })
//     })
// }
//
// const logout = (redirectHome = false) => (dispatch) => {
//   AuthService.logout()
//
//   dispatch({ type: LOGOUT })
//
//   if (redirectHome) {
//     window.location.replace('/')
//   }
// }
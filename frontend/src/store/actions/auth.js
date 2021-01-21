import {
  AUTH_REQUEST,
  AUTH_SUCCESS,
  AUTH_FAILURE,
  RESTORE_AUTH,
  LOGOUT,
} from '../constants/auth'

export const login = (api) => (username, password) => (dispatch) => {
  dispatch({
    type: AUTH_REQUEST,
  })

  api
    .login(username, password)
    .then(() => {
      dispatch({
        type: AUTH_SUCCESS,
      })
    })
    .catch((err) => {
      dispatch({
        type: AUTH_FAILURE,
        error: err.message,
      })
    })
}

export const restoreAuth = (api) => () => (dispatch) => {
  if (!api.isAuthorized()) {
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
  api.logout()
  dispatch({
    type: LOGOUT,
  })
  if (typeof redirect === 'function') {
    redirect()
  }
  // window.location.replace('/')
}

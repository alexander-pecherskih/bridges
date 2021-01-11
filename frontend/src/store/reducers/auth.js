import {
  AUTH_REQUEST,
  AUTH_SUCCESS,
  AUTH_FAILURE,
  LOGOUT, RESTORE_AUTH
} from '../constants/auth'

const initialState = {
  accessToken: null,
  authorized: false,
  loading: true,
  error: null,
}

const auth = (state = initialState, action) => {
  switch (action.type) {
    case AUTH_REQUEST:
      return { ...initialState, loading: true }
    case AUTH_SUCCESS:
      return {
        accessToken: action.accessToken,
        authorized: true,
        loading: false,
        error: null,
      }
    case AUTH_FAILURE:
      return {
        accessToken: null,
        authorized: false,
        loading: false,
        error: action.error,
      }
    case LOGOUT:
      return {
        accessToken: null,
        authorized: false,
        loading: false,
        error: null,
      }
    case RESTORE_AUTH:
      return {
        ...initialState,
        authorized: true,
        loading: false,
      }
    default:
      return state
  }
}

export default auth

export { initialState }

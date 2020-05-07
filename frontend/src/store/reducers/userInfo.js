import { USER_REQUEST, USER_SUCCESS, USER_FAILURE } from '../constants/user'

const initialState = {
  user: null,
  loading: true,
  error: null,
}

const userInfo = (state = initialState, action) => {
  switch (action.type) {
    case USER_REQUEST:
      return {
        user: null,
        loading: true,
        error: null,
      }
    case USER_SUCCESS:
      return {
        user: action.userInfo,
        loading: false,
        error: null,
      }
    case USER_FAILURE:
      return {
        user: null,
        loading: false,
        error: action.error,
      }
    default:
      return state
  }
}

export default userInfo

export { initialState }

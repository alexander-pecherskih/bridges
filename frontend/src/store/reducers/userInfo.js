import { USER_REQUEST, USER_LOADED, USER_FAILURE } from '../constants/user'

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
        case USER_LOADED:
            return {
                user: action.payload,
                loading: false,
                error: null,
            }
        case USER_FAILURE:
            return {
                user: null,
                loading: false,
                error: action.payload,
            }
        default:
            return state
    }
}

export default userInfo
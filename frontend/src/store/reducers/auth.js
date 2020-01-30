import { AUTH_REQUEST, AUTH_SUCCESS, AUTH_FAILURE, LOGOUT } from '../constants/auth'

const initialState = {
    authorized: null,
    loading: true,
    error: null,
}

const auth = (state = initialState, action) => {
    switch (action.type) {
        case AUTH_REQUEST:
            return {
                authorized: null,
                loading: true,
                error: null,
            }
        case AUTH_SUCCESS:
            return {
                authorized: true,
                loading: false,
                error: null,
            }
        case AUTH_FAILURE:
            return {
                authorized: false,
                loading: false,
                error: action.payload,
            }
        case LOGOUT:
            return {
                authorized: false,
                loading: false,
                error: null,
            }
        default:
            return state
    }
}

export default auth
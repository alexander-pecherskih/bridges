import { AUTH_REQUEST, AUTH_SUCCESS, AUTH_FAILURE, LOGOUT } from '../constants/auth'

const initialState = {
    accessToken: null,
    authorized: null,
    loading: true,
    error: null,
}

const auth = (state = initialState, action) => {
    switch (action.type) {
        case AUTH_REQUEST:
            return initialState
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
                error: action.payload,
            }
        case LOGOUT:
            return {
                accessToken: null,
                authorized: false,
                loading: false,
                error: null,
            }
        default:
            return state
    }
}

export default auth
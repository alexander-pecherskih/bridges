const initialState = {
    identity: null,
    loading: true,
    error: null,
};

const auth = (state = initialState, action) => {
    switch (action.type) {
        case 'AUTH_REQUEST':
            return {
                identity: null,
                loading: true,
                error: null,
            }
        case 'AUTH_SUCCESS':
            return {
                identity: action.payload,
                loading: false,
                error: null,
            }
        case 'AUTH_FAILURE':
            return {
                identity: null,
                loading: false,
                error: action.payload,
            }
        case 'LOGOUT':
            return {
                identity: null,
                loading: false,
                error: null,
            }
        default:
            return state
    }
}

export default auth
import { PROCESS_LIST_REQUEST, PROCESS_LIST_SUCCESS, PROCESS_LIST_FAILURE } from '../constants/processList'

const initialState = {
    processes: [],
    loading: true,
    error: null,
}

const processList = (state = initialState, action) => {
    switch (action.type) {
        case PROCESS_LIST_REQUEST:
            return initialState
        case PROCESS_LIST_SUCCESS:
            return {
                processes: action.processes,
                loading: false,
                error: null,
            }
        case PROCESS_LIST_FAILURE:
            return {
                processes: [],
                loading: false,
                error: action.error,
            }
        default:
            return state
    }
}

export default processList

export { initialState }
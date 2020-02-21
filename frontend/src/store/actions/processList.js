import {
    PROCESS_LIST_REQUEST,
    PROCESS_LIST_FAILURE,
    PROCESS_LIST_SUCCESS,
} from '../constants/processList'
import ProcessService from '../../services/ProcessService'

const request = {
    type: PROCESS_LIST_REQUEST,
}

const loaded = (processes) => {
    return {
        type: PROCESS_LIST_SUCCESS,
        processes,
    }
}

const fail = (error) => {
    return {
        type: PROCESS_LIST_FAILURE,
        error,
    }
}

const getProcesses = () => (dispatch, getState) => {
    dispatch(request)

    return ProcessService.getProcesses(getState().auth.accessToken)
        .then((processes) => {
            dispatch( loaded(processes) )
        })
        .catch((error) => {
            dispatch( fail(error) )
        })
}

export { getProcesses }
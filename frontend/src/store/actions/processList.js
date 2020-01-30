import { PROCESS_LIST_REQUEST, PROCESS_LIST_LOADED, PROCESS_LIST_FAILURE } from '../constants/processList'
import ProcessService from '../../services/ProcessService'

const request = {
    type: PROCESS_LIST_REQUEST,
}

const loaded = (processes) => {
    return {
        type: PROCESS_LIST_LOADED,
        processes,
    }
}

const fail = (error) => {
    return {
        type: PROCESS_LIST_FAILURE,
        error,
    }
}

const getProcesses = (dispatch) => () => {
    dispatch(request)

    ProcessService.getProcesses()
        .then((processes) => {
            dispatch( loaded(processes) )
        })
        .catch((err) => {
            dispatch( fail(err.message) )
        })
}

export { getProcesses }
import { PROCESS_REQUEST, PROCESS_SUCCESS, PROCESS_FAILURE, PROCESS_SAVE } from '../constants/process'
import ProcessService from '../../services/ProcessService'

const request = {
    type: PROCESS_REQUEST
}

const success = (process) => {
    return {
        type: PROCESS_SUCCESS,
        process,
    }
}

const save = (process) => {
    return {
        type: PROCESS_SAVE,
        process
    }
}

const saveProcess = (dispatch) => (process) => {
    dispatch(save(process))
    // ...
    setTimeout(() => {
        dispatch(success( process ))
    }, 1000)
}

const fail = (error) => {
    return {
        type: PROCESS_FAILURE,
        error,
    }
}

const getProcess = (dispatch) => () => {
    dispatch(request)
    ProcessService.getProcess()
        .then((process) => {
            dispatch(success( process ))
        })
        .catch((error) => {
            dispatch(fail(error))
        })
}

export { saveProcess, getProcess }
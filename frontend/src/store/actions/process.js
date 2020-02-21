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

const save = {
    type: PROCESS_SAVE,
}

const fail = (error) => {
    return {
        type: PROCESS_FAILURE,
        error,
    }
}

const saveProcess = (process) => (dispatch) => {
    dispatch(save)
    // ...
    return ProcessService.saveProcess(process)
        .then((process) => {
            dispatch(success(process))
        })
        .catch((error) => {
            dispatch(fail(error))
        })
}

const getProcess = (id) => (dispatch) => {
    dispatch(request)

    return ProcessService.getProcess(id)
        .then((process) => {
            dispatch(success( process ))
        })
        .catch((error) => {
            dispatch(fail(error))
        })
}

export { saveProcess, getProcess }
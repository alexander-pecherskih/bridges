import {
  PROCESS_FAILURE,
  PROCESS_REQUEST,
  PROCESS_SUCCESS,
} from '../constants/process'

const getProcess = (api) => (id) => (dispatch) => {
  dispatch({
    type: PROCESS_REQUEST,
  })

  api.process
    .getById(id)
    .then((process) => {
      dispatch({
        type: PROCESS_SUCCESS,
        process,
      })
    })
    .catch((err) => {
      dispatch({
        type: PROCESS_FAILURE,
        error: err.message,
      })
    })
}

const saveProcess = (api) => (process) => (dispatch) => {}

export { getProcess, saveProcess }

import {
  PROCESS_LIST_REQUEST,
  PROCESS_LIST_FAILURE,
  PROCESS_LIST_SUCCESS,
} from '../constants/processList'

const getProcesses = (api) => () => (dispatch, getState) => {
  dispatch({
    type: PROCESS_LIST_REQUEST
  })

  api.processRepository.list()
    .then((processes) => {
      dispatch({
        type: PROCESS_LIST_SUCCESS,
        processes
      })
    })
    .catch((err) => {
      dispatch({
        type: PROCESS_LIST_FAILURE,
        error: err.message
      })
    })
}

export { getProcesses }

import {
  PROCESS_FAILURE,
  PROCESS_REQUEST,
  PROCESS_SUCCESS,
} from '../constants/process'

const initialState = {
  process: null,
  loading: true,
  saving: false,
  error: null,
}

const process = (state = initialState, action) => {
  switch (action.type) {
    case PROCESS_REQUEST:
      return initialState
    case PROCESS_SUCCESS:
      return {
        process: action.process,
        loading: false,
        saving: false,
        error: null,
      }
    case PROCESS_FAILURE:
      return {
        process: null,
        loading: false,
        saving: false,
        error: action.error,
      }
    default:
      return state
  }
}

export default process

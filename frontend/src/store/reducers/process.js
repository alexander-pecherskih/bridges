import {
  PROCESS_REQUEST,
  PROCESS_SUCCESS,
  PROCESS_FAILURE,
  PROCESS_SAVE,
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
    case PROCESS_SAVE:
      return {
        ...state,
        loading: false,
        saving: true,
        error: null,
      }
    case PROCESS_SUCCESS:
      return {
        process: action.process,
        saving: false,
        loading: false,
        error: null,
      }
    case PROCESS_FAILURE:
      return {
        ...initialState,
        loading: false,
        error: action.error,
      }
    default:
      return state
  }
}

export default process

export { initialState }

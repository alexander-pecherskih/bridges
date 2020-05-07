import { combineReducers } from 'redux'
import { auth, userInfo, ticketList, processList, process } from './reducers'

const rootReducer = combineReducers({
  auth,
  userInfo,
  ticketList,
  processList,
  process,
})

export default rootReducer

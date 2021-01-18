import { combineReducers } from 'redux'
import auth from './reducers/auth'
import processList from './reducers/processList'

const rootReducer = combineReducers({
  auth,
  // userInfo,
  // ticketList,
  processList,
  // process,
})

export default rootReducer

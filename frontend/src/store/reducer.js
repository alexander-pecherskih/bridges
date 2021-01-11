import { combineReducers } from 'redux'
import auth from './reducers/auth'

const rootReducer = combineReducers({
  auth,
  // userInfo,
  // ticketList,
  // processList,
  // process,
})

export default rootReducer

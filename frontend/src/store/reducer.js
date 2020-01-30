import { combineReducers } from 'redux'
import { auth, userInfo, ticketList, processList } from './reducers'

const rootReducer = combineReducers({
    auth, userInfo, ticketList, processList
})

export default rootReducer
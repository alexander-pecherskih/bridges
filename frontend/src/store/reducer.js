import { combineReducers } from 'redux'
import { auth, userInfo, ticketList } from './reducers'

const rootReducer = combineReducers({
    auth, userInfo, ticketList
})

export default rootReducer
import { combineReducers } from 'redux'
import { auth, userInfo } from './reducers'

const rootReducer = combineReducers({
    auth, userInfo
})

export default rootReducer
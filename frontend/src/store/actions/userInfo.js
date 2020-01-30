import { USER_REQUEST, USER_LOADED, USER_FAILURE } from '../constants/user'
import UserInfoService from '../../services/UserInfoService'

const request = {
    type: USER_REQUEST,
}

const loaded = (userInfo) => {
    return {
        type: USER_LOADED,
        payload: userInfo,
    }
}

const fail = (error) => {
    return {
        type: USER_FAILURE,
        payload: error,
    }
}

const getUserInfo = (dispatch) => (accessToken) => {
    dispatch(request)

    UserInfoService.getInfo(accessToken)
        .then((data) => {
            const { id, email, name, avatar = '/images/avatar.jpg' } = data
            dispatch(loaded({ id, email, name, avatar }))
        })
        .catch((err) => {
            dispatch(fail(err.message))
        })
}

export { getUserInfo }
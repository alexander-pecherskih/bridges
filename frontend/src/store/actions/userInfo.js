import { USER_REQUEST, USER_SUCCESS, USER_FAILURE } from '../constants/user'
import UserInfoService from '../../services/UserInfoService'

const request = {
    type: USER_REQUEST,
}

const success = (userInfo) => {
    return {
        type: USER_SUCCESS,
        userInfo,
    }
}

const fail = (error) => {
    return {
        type: USER_FAILURE,
        error,
    }
}

const getUserInfo = (accessToken) => (dispatch) => {
    dispatch(request)

    return UserInfoService.getInfo(accessToken)
        .then((data) => {
            const { id, email, name, avatar = '/images/avatar.jpg' } = data
            dispatch(success({ id, email, name, avatar }))
        })
        .catch((error) => {
            dispatch(fail(error))
        })
}

export { getUserInfo }
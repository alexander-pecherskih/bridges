import React, {useEffect} from 'react'
import { compose } from 'redux'
import { connect } from 'react-redux'

import UserInfoService from '../../services/UserInfoService'
import { getUserInfo } from '../../store/actions/userInfo'

import UserView from './UserView'
import UserViewShimmer from './UserViewShimmer'

const UserViewContainer = ({ user, loading, error, getUserInfo }) => {
    // const userInfo = UserInfoService.defaultUserInfo
    useEffect(getUserInfo, [])

    if (!user){
        return <UserViewShimmer />
    }

    return <UserView userInfo={ user } />
}

const mapStateToProps = ({ userInfo: { user, loading, error } }) => {
    return { user, loading, error }
}

const mapDispatchToProps = (dispatch) => {
    return {
        getUserInfo: getUserInfo(dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatchToProps)
)(UserViewContainer)
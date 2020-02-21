import React, {useEffect} from 'react'
import PropTypes from 'prop-types'

import { compose } from 'redux'
import { connect } from 'react-redux'

import { getUserInfo } from '../../store/actions/userInfo'

import UserView from './UserView'
import UserViewShimmer from './UserViewShimmer'

const UserViewContainer = ({ user, loading, error, getUserInfo, accessToken }) => {
    const onMount = () => { getUserInfo(accessToken) }
    useEffect(onMount, [])

    if (!user || loading || error){
        return <UserViewShimmer />
    }

    return <UserView userInfo={ user } />
}

UserViewContainer.propTypes = {
    user: PropTypes.object,
    loading: PropTypes.bool.isRequired,
    getUserInfo: PropTypes.func.isRequired,
    error: PropTypes.string,
    accessToken: PropTypes.string,
}

const mapStateToProps = ({ userInfo: { user, loading, error }, auth: { accessToken } }) => {
    return { user, loading, error, accessToken }
}

const mapDispatchToProps = (dispatch) => {
    return {
        getUserInfo: (accessToken) => dispatch(getUserInfo(accessToken)),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatchToProps)
)(UserViewContainer)
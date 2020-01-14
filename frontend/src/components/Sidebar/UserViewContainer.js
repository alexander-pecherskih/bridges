import React, {useEffect} from 'react'
import PropTypes from 'prop-types'

import { compose } from 'redux'
import { connect } from 'react-redux'

import { getUserInfo } from '../../store/actions/userInfo'

import UserView from './UserView'
import UserViewShimmer from './UserViewShimmer'

const UserViewContainer = ({ user, loading, error, getUserInfo }) => {
    useEffect(getUserInfo, [])

    if (!user || loading || error){
        return <UserViewShimmer />
    }

    return <UserView userInfo={ user } />
}

UserViewContainer.propTypes = {
    user: PropTypes.object,
    loading: PropTypes.bool.isRequired,
    getUserInfo: PropTypes.func.isRequired,
    error: PropTypes.object,
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
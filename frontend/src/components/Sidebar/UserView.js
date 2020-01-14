import React from 'react'
import {Link} from 'react-router-dom'

const UserView = ({ userInfo }) => {
    return <div className="user-view">
        <div className="background"></div>
        <Link to="/profile"><img className="circle user-view__avatar" src={ userInfo.avatar }  alt={ userInfo.name }/></Link>
        <Link to="/profile"><span className="white-text user-view__name">{ userInfo.name }</span></Link>
    </div>
}

export default UserView
import React from 'react'
import {Link} from 'react-router-dom'

const imageStyle = {
    width: '64px',
    height: '64px',
    backgroundColor: 'gray',
}
const textStyle = {
    height: '1rem',
    backgroundColor: 'gray',
    margin: '22px 0 11px 0',
    borderRadius: '5px',
}

const UserViewShimmer = () => {
    return <div className="user-view">
        <div className="background" />
        <div className="circle" style={ imageStyle } />
        <div className="shimmer-text" style={ textStyle } />
    </div>
}

export default UserViewShimmer
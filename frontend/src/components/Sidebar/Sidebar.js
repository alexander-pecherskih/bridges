import React, {useEffect, useRef} from 'react'
import M from 'materialize-css'

const Sidebar = ({ identity }) => {
    const sidebar = useRef(null)

    useEffect(() => {
        M.Sidenav.init(sidebar)
    }, [])

    return <>
        <ul className="sidenav sidenav-fixed sidebar" ref={ sidebar } >
            <li>
                <div className="user-view">
                    <div className="background">
                    </div>
                    {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
                    <a href="#"><img className="circle" src="images/avatar.jpg"  alt=""/></a>
                    {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
                    <a href="#"><span className="white-text name">{ identity.user }</span></a>
                    {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
                    <a href="#"><span className="white-text email">jdandturk@gmail.com</span></a>
                </div>
            </li>
            {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
            <li><a href="#"><i className="material-icons">cloud</i>First Link With Cloud Icon</a></li>
            {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
            <li><a href="#">Second Link</a></li>
            <li><div className="divider"></div></li>
            {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
            <li><a href="#">Third Link With Waves</a></li>
        </ul>
        {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
        {/*<a href="#" data-target="slide-out" className="sidenav-trigger"><i className="material-icons">menu</i></a>*/}
    </>
}

export default Sidebar
import React from 'react'
import Sidebar from '../Sidebar'

const Header = ({ identity, logout }) => {
    return <header className="header">
        <nav className="header__nav">
            <div className="header__nav-wrapper">
                <div className="header__title">
                    Current Page Name
                </div>
            </div>
            <div className="header__nav-wrapper">
                {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
                <ul id="nav-mobile" className="right hide-on-med-and-down">
                    {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
                    <li><a href="#">Menu Item</a></li>
                    {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
                    <li><a href="#">Menu Item</a></li>
                    {/* eslint-disable-next-line jsx-a11y/anchor-is-valid */}
                    <li><a onClick={ logout }>Logout</a></li>
                </ul>
            </div>
        </nav>
        <Sidebar identity={ identity } />
    </header>
}

export default Header
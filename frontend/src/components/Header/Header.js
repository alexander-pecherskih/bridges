import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import { useLocation } from 'react-router'

import Sidebar from '../Sidebar'
import { getPageTitle } from '../../pages'

const Header = ({ logout }) => {
  const location = useLocation()
  useEffect(() => {
    document.title = getPageTitle(location.pathname)
  }, [location])

  return <header className="header">
    <nav className="header__nav">
      <div className="header__nav-wrapper">
        <div className="header__title">
          { getPageTitle(location.pathname, false) }
        </div>
      </div>
      <div className="header__nav-wrapper">
        <ul id="nav-mobile" className="right hide-on-med-and-down">
          {/* eslint-disable-next-line */}
          <li><a onClick={ logout } className="logout-button">Logout</a></li>
        </ul>
      </div>
    </nav>
    <Sidebar />
  </header>
}

Header.propTypes = {
  logout: PropTypes.func.isRequired
}

export default Header

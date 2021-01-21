import React from 'react'
import PropTypes from 'prop-types'

import SidebarMenuButton from './SidebarMenuButton'
import MenuItem from './MenuItem'

import styles from './styles/Navbar.module.css'

const Navbar = ({ toggleSidebar, sidebarIsVisible }) => {
  return (
    <div
      className={`${styles.navbar} ${
        !sidebarIsVisible ? styles.fullWidth : ''
      }`}
    >
      <SidebarMenuButton click={toggleSidebar} />
      <nav>
        {/* <MenuItem url="#" caption="Settings" /> */}
        {/* <MenuItem url="#" caption="Messages" /> */}
        <MenuItem url="/logout" caption="Logout" />
      </nav>
    </div>
  )
}
Navbar.propTypes = {
  toggleSidebar: PropTypes.func.isRequired,
  sidebarIsVisible: PropTypes.bool.isRequired,
}

export default Navbar

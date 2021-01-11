import React from 'react'

import styles from './styles/Navbar.module.css'
import SidebarMenuButton from './SidebarMenuButton'
import MenuItem from './MenuItem'

const Navbar = ({ toggleSidebar, sidebarIsVisible }) => {
  return (
    <div
      className={`${styles.navbar} ${
        !sidebarIsVisible ? styles.fullWidth : ''
      }`}
    >
      <SidebarMenuButton click={toggleSidebar} />
      <nav>
        {/*<MenuItem url="#" caption="Settings" />*/}
        {/*<MenuItem url="#" caption="Messages" />*/}
        <MenuItem url="/logout" caption="Logout" />
      </nav>
    </div>
  )
}

export default Navbar

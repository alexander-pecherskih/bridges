import React  from 'react'

import styles from './styles/SidebarMenuButton.module.css'
import NavbarElement from './NavbarElement'

const SidebarMenuButton = ({ click }) => (
  <NavbarElement>
    <div className={styles.sidebarMenuButton} onClick={click}>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </NavbarElement>
)

export default SidebarMenuButton

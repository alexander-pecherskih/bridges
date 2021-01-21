import React from 'react'
import SidebarElement from './SidebarElement'

import styles from './styles/MenuItem.module.css'
import { NavLink } from 'react-router-dom'

const MenuItem = ({ caption, url }) => {
  return (
    <SidebarElement>
      <NavLink className={styles.menuItem} to={url}>{caption}</NavLink>
    </SidebarElement>
  )
}

export default MenuItem

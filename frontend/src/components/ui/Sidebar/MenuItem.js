import React from 'react'
import SidebarElement from './SidebarElement'

import styles from './styles/MenuItem.module.css'

const MenuItem = ({ caption, url }) => {
  return (
    <SidebarElement>
      <a href={url} className={styles.menuItem}>
        {caption}
      </a>
    </SidebarElement>
  )
}

export default MenuItem

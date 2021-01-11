import React from 'react'
import NavbarElement from './NavbarElement'

import styles from './styles/MenuItem.module.css'

const MenuItem = ({ caption, url }) => (
  <NavbarElement>
    <a href={url} className={styles.menuItem}>
      {caption}
    </a>
  </NavbarElement>
)

export default MenuItem

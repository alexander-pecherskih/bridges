import React from 'react'
import NavbarElement from './NavbarElement'

import styles from './styles/MenuItem.module.css'
import { Link } from 'react-router-dom'

const MenuItem = ({ caption, url }) => (
  <NavbarElement>
    <Link to={url} className={styles.menuItem}>
      {caption}
    </Link>
  </NavbarElement>
)

export default MenuItem

import React from 'react'

import styles from './styles/NavbarElement.module.css'

const NavbarElement = ({ children }) => (
  <div className={styles.navbarElement}>{children}</div>
)

export default NavbarElement

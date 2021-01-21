import React from 'react'

import styles from './styles/SidebarElement.module.css'

const SidebarElement = ({ children }) => (
  <div className={styles.sidebarElement}>{children}</div>
)

export default SidebarElement

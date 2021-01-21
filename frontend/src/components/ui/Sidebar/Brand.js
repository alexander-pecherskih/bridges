import React from 'react'
import SidebarElement from './SidebarElement'

import styles from './styles/Brand.module.css'
import Logo from '../Logo/Logo'

const Brand = ({ caption }) => {
  return (
    <SidebarElement>
      <div className={styles.brand}>
        <Logo size={32} />
        <div className={styles.caption}>{caption}</div>
      </div>
    </SidebarElement>
  )
}

export default Brand

import React from 'react'
import SidebarElement from './SidebarElement'

import styles from './styles/Title.module.css'

const Title = ({ caption }) => {
  return (
    <SidebarElement>
      <div className={styles.title}>{caption}</div>
    </SidebarElement>
  )
}

export default Title

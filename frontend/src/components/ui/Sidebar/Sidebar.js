import React from 'react'

import styles from './styles/Sidebar.module.css'
import MenuItem from './MenuItem'
import Title from './Title'
import Brand from './Brand'

const Sidebar = ({ visible }) => {
  return (
    <>
      <Brand caption="Bridges" />
      <nav className={`${styles.sidebar} ${visible ? '' : styles.hidden}`}>
        <Title caption="trololo" />
        <MenuItem caption="Menu Item 1" url="#" />
        <MenuItem caption="Menu Item 4" url="#" />
      </nav>
    </>
  )
}

export default Sidebar

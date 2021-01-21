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
        <Title caption="processes" />
        <MenuItem caption="Tickets" url="/" />
        <Title caption="config" />
        <MenuItem caption="Process List" url="/process-list" />
      </nav>
    </>
  )
}

export default Sidebar

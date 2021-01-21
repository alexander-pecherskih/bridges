import React from 'react'
import PropTypes from 'prop-types'
import { NavLink } from 'react-router-dom'

import SidebarElement from './SidebarElement'
import styles from './styles/MenuItem.module.css'

const MenuItem = ({ caption, url }) => {
  return (
    <SidebarElement>
      <NavLink className={styles.menuItem} to={url}>
        {caption}
      </NavLink>
    </SidebarElement>
  )
}
MenuItem.propTypes = {
  caption: PropTypes.string.isRequired,
  url: PropTypes.string.isRequired,
}

export default MenuItem

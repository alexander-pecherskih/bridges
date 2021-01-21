import React from 'react'
import PropTypes from 'prop-types'

import NavbarElement from './NavbarElement'

import styles from './styles/SidebarMenuButton.module.css'

const SidebarMenuButton = ({ click }) => (
  <NavbarElement>
    <div className={styles.sidebarMenuButton} onClick={click}>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </NavbarElement>
)
SidebarMenuButton.propTypes = {
  click: PropTypes.func.isRequired,
}

export default SidebarMenuButton

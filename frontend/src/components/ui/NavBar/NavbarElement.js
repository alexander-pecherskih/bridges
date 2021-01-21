import React from 'react'
import PropTypes from 'prop-types'

import styles from './styles/NavbarElement.module.css'

const NavbarElement = ({ children }) => (
  <div className={styles.navbarElement}>{children}</div>
)
NavbarElement.propTypes = {
  children: PropTypes.element,
}

export default NavbarElement

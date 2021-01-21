import React from 'react'
import PropTypes from 'prop-types'

import styles from './styles/SidebarElement.module.css'

const SidebarElement = ({ children }) => (
  <div className={styles.sidebarElement}>{children}</div>
)
SidebarElement.propTypes = {
  children: PropTypes.element,
}

export default SidebarElement

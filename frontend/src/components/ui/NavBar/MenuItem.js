import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'

import NavbarElement from './NavbarElement'
import styles from './styles/MenuItem.module.css'

const MenuItem = ({ caption, url }) => (
  <NavbarElement>
    <Link to={url} className={styles.menuItem}>
      {caption}
    </Link>
  </NavbarElement>
)
MenuItem.propTypes = {
  caption: PropTypes.string.isRequired,
  url: PropTypes.string.isRequired,
}

export default MenuItem

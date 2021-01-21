import React from 'react'
import PropTypes from 'prop-types'

import SidebarElement from './SidebarElement'
import Logo from '../Logo/Logo'

import styles from './styles/Brand.module.css'

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
Brand.propTypes = {
  caption: PropTypes.string.isRequired,
}

export default Brand

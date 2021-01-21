import React from 'react'
import PropTypes from 'prop-types'

import styles from './styles/MainWrapper.module.css'

const MainWrapper = ({ children, sidebarIsVisible }) => {
  return (
    <main
      className={`${styles.mainWrapper} ${
        sidebarIsVisible ? styles.withSidebar : ''
      }`}
    >
      {children}
    </main>
  )
}
MainWrapper.propTypes = {
  children: PropTypes.element,
  sidebarIsVisible: PropTypes.bool.isRequired,
}

export default MainWrapper

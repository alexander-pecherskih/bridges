import React, { useState } from 'react'
import PropTypes from 'prop-types'

import styles from './styles/DefaultLayout.module.css'
import Sidebar from '../../ui/Sidebar'
import MainWrapper from './MainWrapper'
import Navbar from '../../ui/NavBar'
import PageWrapper from './PageWrapper'

const DefaultLayout = ({ children }) => {
  const [sidebarVisible, setSidebarVisible] = useState(true)
  const handleToggleSidebar = () => {
    setSidebarVisible((prev) => !prev)
  }

  return (
    <div className={styles.defaultLayout}>
      <Sidebar visible={sidebarVisible} />
      <MainWrapper sidebarIsVisible={sidebarVisible}>
        <Navbar
          toggleSidebar={handleToggleSidebar}
          sidebarIsVisible={sidebarVisible}
        />
        <PageWrapper>{children}</PageWrapper>
      </MainWrapper>
    </div>
  )
}
DefaultLayout.propTypes = {
  children: PropTypes.element,
}

export default DefaultLayout

import React from 'react'
import styles from './styles/MainWrapper.module.css'

const MainWrapper = ({
  children,
  sidebarIsVisible,
}) => {
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

export default MainWrapper

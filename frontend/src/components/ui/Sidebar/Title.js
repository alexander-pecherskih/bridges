import React from 'react'
import PropTypes from 'prop-types'
import SidebarElement from './SidebarElement'

import styles from './styles/Title.module.css'

const Title = ({ caption }) => {
  return (
    <SidebarElement>
      <div className={styles.title}>{caption}</div>
    </SidebarElement>
  )
}

Title.propTypes = {
  caption: PropTypes.string,
}

export default Title

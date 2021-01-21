import React from 'react'
import PropTypes from 'prop-types'

import styles from './styles/CenteredLayout.module.css'

const CenteredLayout = ({ children }) => {
  return <main className={styles.centeredLayout}>{children}</main>
}
CenteredLayout.propTypes = {
  children: PropTypes.element,
}

export default CenteredLayout

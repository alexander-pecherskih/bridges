import React from 'react'
import PropTypes from 'prop-types'

import styles from './styles/PageWrapper.module.css'

const PageWrapper = ({ children }) => (
  <div className={styles.pageWrapper}>{children}</div>
)
PageWrapper.propTypes = {
  children: PropTypes.element,
}

export default PageWrapper

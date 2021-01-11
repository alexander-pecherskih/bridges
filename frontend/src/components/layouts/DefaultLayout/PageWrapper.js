import React from 'react'
import styles from './styles/PageWrapper.module.css'

const PageWrapper = (
  { children }
) => (
  <div className={styles.pageWrapper}>{children}</div>
)

export default PageWrapper
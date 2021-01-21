import React from 'react'

import styles from './styles/CenteredLayout.module.css'

const CenteredLayout = (
  { children }
) => {
  return <main className={styles.centeredLayout}>{children}</main>
}

export default CenteredLayout

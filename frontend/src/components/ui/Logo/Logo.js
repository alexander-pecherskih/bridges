import React from 'react'

import { ReactComponent as Icon } from './assets/logo.svg'
import styles from './styles/Logo.module.css'


const Logo = ({ size = 60 }) => (
  <div style={{ width: size, height: size }} className={styles.logo}>
    <Icon />
  </div>
)

export default Logo

import React from 'react'

import styles from './styles/Card.module.css'

const Title = ({ title }) => (
  <div className={styles.title}>{title}</div>
)

const Card = ({ children, title }) => (
  <div className={styles.card}>
    {title ? <Title title={title} /> : null}
    <div className={styles.content}>{children}</div>
  </div>
)

export default Card

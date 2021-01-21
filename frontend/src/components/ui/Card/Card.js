import React from 'react'
import PropTypes from 'prop-types'

import styles from './styles/Card.module.css'

const Title = ({ title }) => <div className={styles.title}>{title}</div>
Title.propTypes = {
  title: PropTypes.string.isRequired,
}

const Card = ({ children, title }) => (
  <div className={styles.card}>
    {title ? <Title title={title} /> : null}
    <div className={styles.content}>{children}</div>
  </div>
)
Card.propTypes = {
  children: PropTypes.element,
  title: PropTypes.string,
}

export default Card

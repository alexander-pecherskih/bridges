import React from 'react'
import PropTypes from 'prop-types'

import styles from './styles/Table.module.css'

const Table = ({ rows, headRows = null, message = '' }) => {
  if (rows.length === 0 && message.length > 0) {
    return <div>{message}</div>
  }

  return (
    <table className={styles.table}>
      {headRows ? <thead>{headRows}</thead> : null}
      <tbody>{rows}</tbody>
    </table>
  )
}

Table.propTypes = {
  rows: PropTypes.array,
  headRows: PropTypes.element,
  message: PropTypes.string,
}

export default Table

import React from 'react'
import PropTypes from 'prop-types'

import { Link } from 'react-router-dom'
import Table from '../../ui/Table'

const ProcessRow = ({ process }) => {
  return (
    <tr>
      <td>
        {process.id}
        &nbsp;-&nbsp;
        <Link to={`/process/${process.id}`}>diagram</Link>
      </td>
      <td>{process.title}</td>
    </tr>
  )
}

ProcessRow.propTypes = {
  process: PropTypes.object,
}

const ProcessList = ({ processes, loading, errorMessage }) => {
  const rows = processes.map((item) => {
    return <ProcessRow process={item} key={item.id} />
  })
  let message = ''

  if (loading) {
    message = 'Loading...'
  } else if (rows.length === 0) {
    message = 'No one Process Found'
  }

  if (errorMessage) {
    message = errorMessage
  }

  const headRows = (
    <tr>
      <th>id</th>
      <th>title</th>
    </tr>
  )

  return <Table rows={rows} headRows={headRows} message={message} />
}

ProcessList.propTypes = {
  processes: PropTypes.array.isRequired,
  loading: PropTypes.bool.isRequired,
  errorMessage: PropTypes.string,
}

export default ProcessList

import React from 'react'
import PropTypes from 'prop-types'

import TBodyMessage from '../../common/TBodyMessage'
import { Link } from 'react-router-dom'

const ProcessRow = ({ process }) => {
  return <tr>
    <td>
      { process.id }
            &nbsp;-&nbsp;
      <Link to={`/process/${process.id}`}>diagram</Link>
    </td>
    <td>{ process.title }</td>
  </tr>
}

ProcessRow.propTypes = {
  process: PropTypes.object
}

const ProcessList = ({ processes, loading, errorMessage }) => {
  let rows = processes.map((item) => {
    return <ProcessRow process={ item } key={ item.id }/>
  })

  if (loading) {
    rows = <TBodyMessage colSpan={ 2 } message="Loading..." />
  } else if (rows.length === 0) {
    rows = <TBodyMessage colSpan={ 2 } message="No one Process Found" />
  }

  if (errorMessage) {
    rows = <TBodyMessage colSpan={ 2 } message={ errorMessage } />
  }

  return <table>
    <thead>
      <tr>
        <th>id</th>
        <th>title</th>
      </tr>
    </thead>
    <tbody>
      { rows }
    </tbody>
  </table>
}

ProcessList.propTypes = {
  processes: PropTypes.array.isRequired,
  loading: PropTypes.bool.isRequired,
  errorMessage: PropTypes.string
}

export default ProcessList

import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import { bindActionCreators, compose } from 'redux'
import { connect } from 'react-redux'

import { getProcesses } from '../../../store/actions/processList'
import ProcessList from './ProcessList'
import { withApi } from '../../../packages/api'

const ProcessListContainer = ({ processes, loading, error, getProcesses }) => {
  useEffect(getProcesses, [])

  return (
    <ProcessList processes={processes} loading={loading} errorMessage={error} />
  )
}

ProcessListContainer.propTypes = {
  processes: PropTypes.array.isRequired,
  loading: PropTypes.bool.isRequired,
  error: PropTypes.string,
  getProcesses: PropTypes.func.isRequired,
}

const mapStateToProps = ({ processList: { processes, loading, error } }) => {
  return { processes, loading, error }
}

const mapDispatchToProps = (dispatch, { api }) => {
  return bindActionCreators({
    getProcesses: getProcesses(api),
  }, dispatch)
}

export default compose(
  withApi(),
  connect(mapStateToProps, mapDispatchToProps)
)(ProcessListContainer)

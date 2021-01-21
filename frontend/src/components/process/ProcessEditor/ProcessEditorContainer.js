import React, { useEffect } from 'react'
import PropTypes from 'prop-types'

import { getProcess, saveProcess } from '../../../store/actions/process'
import { bindActionCreators, compose } from 'redux'
import { connect } from 'react-redux'
import { useParams } from 'react-router'

import Spinner from '../../ui/Spinner'
import { withApi } from '../../../packages/api'
import ProcessEditor from './ProcessEditor'

const ProcessEditorContainer = (props) => {
  const onMount = () => {
    getProcess(urlParams.id)
  }
  const { getProcess, process } = props
  const urlParams = useParams()
  useEffect(onMount, [])

  if (!process) {
    return <Spinner />
  }

  return <ProcessEditor {...props} />
}

ProcessEditorContainer.propTypes = {
  process: PropTypes.object,
  loading: PropTypes.bool.isRequired,
  saving: PropTypes.bool.isRequired,
  error: PropTypes.string,
  getProcess: PropTypes.func.isRequired,
  saveProcess: PropTypes.func.isRequired,
}

const mapStateToProps = ({ process: { process, loading, saving, error } }) => {
  return { process, loading, saving, error }
}

const mapDispatchToProps = (dispatch, { api }) => {
  return bindActionCreators({
    getProcess: getProcess(api),
    saveProcess: saveProcess(api)
  }, dispatch)
}

export default compose(
  withApi(),
  connect(mapStateToProps, mapDispatchToProps)
)(ProcessEditorContainer)

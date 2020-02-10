import React, { useEffect } from 'react'
import PropTypes from 'prop-types'

import { getProcess, saveProcess } from '../../../store/actions/process'
import { compose } from 'redux'
import { connect } from 'react-redux'
import { useParams } from 'react-router'

import ProcessDiagram from './ProcessDiagram'
import TextMessage from '../../common/TextMessage'

const ProcessDiagramContainer = (props) => {
    const { getProcess } = props;
    const urlParams = useParams()
    const load = () => {
        getProcess(urlParams.id)
    }
    useEffect(load, [])

    if (!props.process) {
        return <TextMessage message="Loading..." />
    }

    return <ProcessDiagram { ...props }/>
}

ProcessDiagramContainer.propTypes = {
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

const mapDispatchToProps = (dispatch) => {
    return {
        getProcess: getProcess(dispatch),
        saveProcess: saveProcess(dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatchToProps)
)(ProcessDiagramContainer)
import React, { useEffect } from 'react'
import { useParams } from 'react-router'

import ProcessPropsEditor from './ProcessPropsEditor'
import { compose } from 'redux'
import { connect } from 'react-redux'
import { getProcess, saveProcess } from '../../../store/actions/process'
import PropTypes from 'prop-types'

const ProcessPropsEditorContainer = (props) => {
    const { getProcess } = props;
    const urlParams = useParams()
    const load = () => {
        getProcess(urlParams.id)
    }
    useEffect(load, [])

    return <ProcessPropsEditor { ...props } />
}

ProcessPropsEditor.propTypes = {
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
)(ProcessPropsEditorContainer)
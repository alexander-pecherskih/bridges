import React, { useEffect } from 'react'
import { useParams } from 'react-router'

import ProcessPropsEditor from './ProcessPropsEditor'
import { compose } from 'redux'
import { connect } from 'react-redux'
import { getProcess, saveProcess } from '../../../store/actions/process'

const ProcessPropsEditorContainer = (props) => {
    const { getProcess } = props;
    const urlParams = useParams()
    const load = () => {
        getProcess(urlParams.id)
    }
    useEffect(load, [])

    return <ProcessPropsEditor { ...props } />
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
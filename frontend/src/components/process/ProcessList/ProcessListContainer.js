import React, {useEffect} from 'react'
import PropTypes from 'prop-types'
import { compose } from 'redux'
import { connect } from 'react-redux'

import { getProcesses } from '../../../store/actions/processList'
import ProcessList from './ProcessList'

const ProcessListContainer = ({ processes, loading, error, getProcesses }) => {
    useEffect(getProcesses, [])

    return <ProcessList processes={ processes } loading={ loading } errorMessage={ error }/>
}

ProcessListContainer.propTypes = {
    processes: PropTypes.array.isRequired,
    loading: PropTypes.bool.isRequired,
    error: PropTypes.object,
    getProcesses: PropTypes.func.isRequired,
}

const mapStateToProps = ({ processList: { processes, loading, error } }) => {
    return { processes, loading, error }
}

const mapDispatchToProps = (dispatch) => {
    return {
        getProcesses: getProcesses(dispatch),
    }
}

export default compose(
    connect(mapStateToProps, mapDispatchToProps)
)(ProcessListContainer)
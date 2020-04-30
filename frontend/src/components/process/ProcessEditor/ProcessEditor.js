import React from 'react'
import PropTypes  from 'prop-types'

import './styles/diagram.sass'
import Diagram from './Diagram'

const ProcessEditor = ({ process }) => {
    const nodes = [process.nodes[0], process.nodes[1]]
    const routes = [process.routes[0]]
    // const nodes = process.nodes

    return <>
        <h4>{ process.title }</h4>
        <Diagram
            connections={ routes }
            nodes={ nodes }
            // selectNode={ selectNode }
            // selectedNodeId={ selectedNode ? selectedNode.id : null }
            // updateNodePosition={ updateNodePosition }
        />
    </>
}

ProcessEditor.propTypes = {
    process: PropTypes.object,
    loading: PropTypes.bool.isRequired,
    saving: PropTypes.bool.isRequired,
    error: PropTypes.string,
    getProcess: PropTypes.func.isRequired,
    saveProcess: PropTypes.func.isRequired,
}

export default ProcessEditor
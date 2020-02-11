import React, { useState } from 'react'
import PropTypes  from 'prop-types'

import './styles/diagram.sass'
import Diagram from './Diagram'
import Toolbar from '../Toolbar'

const ProcessDiagram = (props) => {
    const initialProcess = props.process
    const [nodes, setNodes] = useState([...initialProcess.nodes])
    const [process]         = useState({ id: initialProcess.id, name: initialProcess.name })
    const [connections]     = useState(initialProcess.connections)

    const addNode = (nodeName, nextId) => {
        if (nodeName.length > 0) {
            setNodes([
                ...nodes, { id: nextId, name: nodeName, position: { left: 100, top: 100 }, fields: [] }
            ])
        }
    }
    const updateNode = (id, nodeName) => {
        const nodeIndex = nodes.findIndex(item => item.id === id)
        const newNodes  = [ ...nodes ]
        newNodes[nodeIndex].name = nodeName

        setNodes(newNodes)
    }
    const selectNode = (id) => {
        const nodeIndex = nodes.findIndex(item => item.id === id)
        const newNodes = nodes.map( item => { return { ...item, selected: false } })

        newNodes[nodeIndex].selected = true
        setNodes([...newNodes])
    }

    return <>
        <Toolbar process={ process } nodes={ nodes } addNode={ addNode } updateNode={ updateNode }/>
        <Diagram
            connections={ connections }
            nodes={ nodes }
            selectNode={ selectNode }
        />
    </>
}

ProcessDiagram.propTypes = {
    process: PropTypes.object,
    loading: PropTypes.bool.isRequired,
    saving: PropTypes.bool.isRequired,
    error: PropTypes.string,
    getProcess: PropTypes.func.isRequired,
    saveProcess: PropTypes.func.isRequired,
}

export default ProcessDiagram
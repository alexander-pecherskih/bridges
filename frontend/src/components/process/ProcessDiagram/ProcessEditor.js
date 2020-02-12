import React, { useState } from 'react'
import PropTypes  from 'prop-types'

import './styles/diagram.sass'
import Diagram from './Diagram'
import Toolbar from './Toolbar'
import FieldsEditor from './FieldsEditor'

const DIAGRAM_EDITOR = 'DIAGRAM_EDITOR'
const FIELDS_EDITOR  = 'FIELDS_EDITOR'

const ProcessEditor = (props) => {
    const initialProcess = props.process
    const [nodes, setNodes] = useState([...initialProcess.nodes])
    // const [process]         = useState({ id: initialProcess.id, name: initialProcess.name })
    const [connections]     = useState(initialProcess.connections)
    const [currentEditor, setCurrentEditor] = useState(DIAGRAM_EDITOR)
    const [selectedNode, setSelectedNode] = useState(null)

    const addNode = (nodeName) => {
        if (nodeName.length > 0) {
            const nextId = nodes.length + 1
            setNodes([
                ...nodes, { id: nextId, name: nodeName, position: { left: 100, top: 100 }, fields: [] }
            ])
        }
    }
    const renameNode = (id, nodeName) => {
        if (nodeName && nodeName.length > 0) {
            const nodeIndex = nodes.findIndex( item => item.id === id )
            const newNodes = [ ...nodes ]
            newNodes[nodeIndex].name = nodeName

            setNodes( newNodes )
        }
    }
    const selectNode = (id) => {
        const node = nodes.find( item => item.id === id)
        setSelectedNode(node)
    }

    return <>
        { currentEditor === DIAGRAM_EDITOR &&
            <>
                <Toolbar
                    buttons={ [
                        {
                            label: 'Добавить узел',
                            handler: () => addNode(prompt('Введите название узла')),
                        },
                        {
                            label: 'Переименовать узел',
                            handler: () => renameNode(prompt('Введите название узла', selectedNode.name)),
                            disabled: !selectedNode,
                        },
                        {
                            label: 'Поля',
                            handler: () => setCurrentEditor( FIELDS_EDITOR ),
                            disabled: !selectedNode,
                        },
                    ] }
                />
                <Diagram
                    connections={ connections }
                    nodes={ nodes }
                    selectNode={ selectNode }
                    selectedNodeId={ selectedNode ? selectedNode.id : null }
                />
            </>
        }
        { currentEditor === FIELDS_EDITOR &&
            <>
                <Toolbar
                    buttons={ [
                        {
                            label: 'Диаграмма',
                            handler: () => setCurrentEditor( DIAGRAM_EDITOR ),
                            icon: 'chevron_left',
                        },
                        {
                            label: 'Добавить',
                            handler: () => {},
                        },
                    ] }
                />
                <FieldsEditor node={ selectedNode }/>
            </>
        }
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
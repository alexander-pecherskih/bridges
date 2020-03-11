import React, { useState } from 'react'
import PropTypes  from 'prop-types'

import './styles/diagram.sass'
import Diagram from './Diagram'
import Toolbar from './Toolbar'
import FieldsEditor from './FieldsEditor'
import ProcessPropsEditor from './ProcessPropsEditor'

const DIAGRAM_EDITOR = 'DIAGRAM_EDITOR'
const FIELDS_EDITOR  = 'FIELDS_EDITOR'
const PROCESS_PROPS_EDITOR = 'PROCESS_PROPS_EDITOR'

const ProcessEditor = (props) => {
    const initialProcess = props.process
    const [nodes, setNodes] = useState([...initialProcess.nodes])
    const [process, setProcess] = useState({ id: initialProcess.id, title: initialProcess.title })
    const [connections] = useState(initialProcess.routes)
    const [currentEditor, setCurrentEditor] = useState(DIAGRAM_EDITOR)
    const [selectedNode, setSelectedNode] = useState(null)

    const addNode     = (nodeName) => {
        if (nodeName && nodeName.length > 0) {
            const nextId = nodes.length + 1
            setNodes([
                ...nodes, { id: nextId + '', title: nodeName, position: { left: 100, top: 100 }, fields: [] }
            ])
        }
    }
    const renameNode  = (id, nodeName) => {
        if (nodeName && nodeName.length > 0) {
            const nodeIndex = nodes.findIndex( item => item.id === id )
            const newNodes = [ ...nodes ]
            newNodes[nodeIndex].title = nodeName

            setNodes( newNodes )
        }
    }
    const selectNode  = (id) => {
        const node = nodes.find( item => item.id === id)
        setSelectedNode(node)
    }
    const saveProcess = (newProcess) => {
        setProcess(newProcess)
        setCurrentEditor( DIAGRAM_EDITOR )
    }
    const saveFields  = (fields) => {
        setCurrentEditor( DIAGRAM_EDITOR )
    }
    const updateNodePosition = (id, position) => {
        const nodeIndex = nodes.findIndex( item => item.id === id )
        const newNodes = [ ...nodes ]
        newNodes[nodeIndex].position = position

        setNodes( newNodes )
    }

    return <>
        { currentEditor === DIAGRAM_EDITOR &&
            <>
                <Toolbar
                    buttons={ [
                        {
                            label: 'Настройки процесса',
                            handler: () => setCurrentEditor( PROCESS_PROPS_EDITOR )
                        },
                        {
                            label: 'Добавить узел',
                            handler: () => addNode(prompt('Введите название узла')),
                        },
                        {
                            label: 'Переименовать узел',
                            handler: () => renameNode(selectedNode.id, prompt('Введите название узла', selectedNode.title)),
                            disabled: !selectedNode,
                        },
                        {
                            label: 'Поля',
                            handler: () => setCurrentEditor( FIELDS_EDITOR ),
                            disabled: !selectedNode,
                        },
                    ] }
                />
                <h4>{ process.title }</h4>
                <Diagram
                    connections={ connections }
                    nodes={ nodes }
                    selectNode={ selectNode }
                    selectedNodeId={ selectedNode ? selectedNode.id : null }
                    updateNodePosition={ updateNodePosition }
                />
            </>
        }
        { currentEditor === FIELDS_EDITOR &&
            <FieldsEditor node={ selectedNode } saveFields={ saveFields }/>
        }
        { currentEditor === PROCESS_PROPS_EDITOR &&
            <ProcessPropsEditor process={ process } saveProcess={ saveProcess } />
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
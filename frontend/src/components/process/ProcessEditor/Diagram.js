import React, { useEffect } from 'react'
import PropTypes from 'prop-types'

import { jsPlumb } from '../../common/jsPlumb'

import './styles/diagram.sass'
import Node from './Node'

const connectorConf = {
    anchors: ['Right', 'Left'],
    endpoints: ['Blank', 'Blank'],
    paintStyle: { stroke: '#445566', strokeWidth: 2 },
}

const DIAGRAM_CONTAINER_ID = 'diagram-container'

const initConnections = (connections, jsPlumb) => {
    connections.forEach( item => {
        jsPlumb.connect( {
            source: `node-${ item.source_id }`,
            target: `node-${ item.target_id }`,
            overlays: [
                [ 'Arrow', { location: 1 } ],
            ],
        }, connectorConf )
    })
}

const Diagram = ({ nodes, connections, selectNode, selectedNodeId }) => {
    useEffect( () => {
        jsPlumb.setContainer( document.getElementById(DIAGRAM_CONTAINER_ID) )
        initConnections(connections, jsPlumb)

       return () => jsPlumb.deleteEveryConnection()
    }, [connections])

    const nodeList = nodes.map(item => {
        return <Node
            node={ item }
            key={ item.id }
            containerId={ DIAGRAM_CONTAINER_ID }
            selected={ selectedNodeId === item.id || false }
            select={ selectNode }
        />
    })

    return <div className="diagram-container" id={ DIAGRAM_CONTAINER_ID } >
        { nodeList }
    </div>
}

Diagram.propTypes = {
    connections: PropTypes.array.isRequired,
    nodes: PropTypes.array.isRequired,
    selectNode: PropTypes.func.isRequired,
    selectedNodeId: PropTypes.string,
}

export default Diagram
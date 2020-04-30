import React from 'react'

import Node from './Node'
import Connection from './Connection'

const updateConnections = (connections, nodeId, rect) => {
    return connections.map((item) => {
        if (item.source.id === nodeId) {
            item.source.rect = rect
        }
        if (item.target.id === nodeId) {
            item.target.rect = rect
        }

        return item
    })
}

class Diagram extends React.Component {
    state = {
        connections: []
    }

    handleNodeMove = (nodeId, rect) => {
        this.setState((state) => {
            return { connections: updateConnections([ ...state.connections ], nodeId, rect) }
        })
    }

    componentDidMount() {
        this.setState({
            connections: this.props.connections.map(item => ({
                id: item.id,
                source: { id: item.source_id, rect: null },
                target: { id: item.target_id, rect: null },
            }))
        })
    }

    render () {
        const { nodes } = this.props
        const { connections } = this.state
        const nodeList = nodes.map(
            item => <Node
                node={ item }
                key={ item.id }
                onMove={ (rect) => this.handleNodeMove(item.id, rect) }
            />
        )
        const connectionList = connections.map(
            item => <Connection
                connection={ item }
                key={ item.id }
            />
        )

        return <>
            { nodeList }
            { connectionList }
        </>
    }
}

export default Diagram
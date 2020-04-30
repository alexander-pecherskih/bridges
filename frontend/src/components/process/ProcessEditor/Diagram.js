import React from 'react'

import Node from './Node'
import Connection from './Connection'

const updateConnections = (connections, nodeId, rect) => {
    const connectionSrcIndex = connections.findIndex(
        (item, index) => item.source.id === nodeId
    )
    const connectionTargetIndex = connections.findIndex(
        (item, index) => item.target.id === nodeId
    )

    return connections.map((item, index) => {
        let source = { ...item.source }
        let target = { ...item.target }
        if (index === connectionSrcIndex) {
            source = { ...item.source, rect }
        }
        if (index === connectionTargetIndex) {
            target = { ...item.target, rect }
        }
        return { ...item, source, target }
    })
}

class Diagram extends React.Component {
    state = {
        connections: []
    }

    handleNodeMove = (nodeId, rect) => {
        this.setState((state) => {
            return { connections: updateConnections(state.connections, nodeId, rect) }
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
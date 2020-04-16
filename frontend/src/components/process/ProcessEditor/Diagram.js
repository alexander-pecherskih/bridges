import React from 'react'

import Node from './Node'
import Connection from './Connection'

class Diagram extends React.Component {
    state = {
        connections: []
    }

    handleNodeMove = (nodeId, rect) => {
        const { connections } = this.state
        const connectionSrcIndex = connections.findIndex(
            (item, index) => item.source.id === nodeId
        )
        const connectionTargetIndex = connections.findIndex(
            (item, index) => item.target.id === nodeId
        )
        const newConnections = connections.map((item, index) => {
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

        this.setState({ connections: newConnections })
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
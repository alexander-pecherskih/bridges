import React, { useEffect } from 'react'
import PropTypes from 'prop-types'

import { jsPlumb } from '../../common/jsPlumb'

import Node from './Node'

import './styles/diagram.sass'
import Toolbar from '../Toolbar'

const connectorConf = {
    anchors: ['Right', 'Left'],
    endpoints: ['Blank', 'Blank'],
    paintStyle: { stroke: '#445566', strokeWidth: 2 },
}

const CANVAS_ID = 'diagram-container'

const initDiagram = ({ nodes }) => {
    jsPlumb.setContainer(CANVAS_ID)

    nodes.forEach( (node) => {
        jsPlumb.draggable(`node-${ node.id }`)

        if (node.parent !== undefined) {
            jsPlumb.connect({
                source: `node-${ node.parent }`,
                target: `node-${ node.id }`,
                overlays: [
                    ['Arrow', { location: 1 }]
                ]
            }, connectorConf);
        }
    })

    return () => {
        nodes.forEach(( node ) => {
            jsPlumb.remove(`node-${ node.id }`)
        })
        // jsPlumb.deleteEveryConnection()
    }
}

const ProcessDiagram = ({ process }) => {
    useEffect(() => {
        return initDiagram(process)
    }, [process])

    const nodes = process.nodes.map( (node) => {
        const { top = 0, left = 0 } = node.position

        return <Node node={ node } key={ node.id } top={ top } left={ left } />
    });

    return <>
        <Toolbar process={ process } />
        <div id={ CANVAS_ID }>
            { nodes }
        </div>
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
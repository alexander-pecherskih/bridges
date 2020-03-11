import React, { useEffect } from 'react'
import PropTypes from 'prop-types'

import './styles/node.sass'

import { jsPlumb } from '../../common/jsPlumb'

const Node = ({ node, containerId, selected, select, updateNodePosition }) => {
    const updatePosition = (left, top) => { updateNodePosition(node.id, { left, top }) }

    useEffect(() => {
        jsPlumb.setContainer( document.getElementById(containerId) )
        jsPlumb.draggable(`node-${ node.id }`, {
            stop: (e) => updatePosition(e.finalPos[0], e.finalPos[1])
        })

        return () => jsPlumb.remove(`node-${ node.id }`)
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [node.id, containerId])

    const nodeStyle = {
        left: node.position.left,
        top:  node.position.top
    }

    const fields = node.fields ? node.fields.map( (field) => {
        return (
            <li className="node__field" key={ field.id }>{ field.name } : { field.type }</li>
        );
    }) : null;

    const selectedClass = selected ? ' node_selected' : ''

    return (
        <div className={ `node${selectedClass}` } style={ nodeStyle } id={`node-${ node.id }`} onClick={ () => select(node.id) }>
            <div className="node__title">{ node.title }</div>

            <ul className="node__fields">
                { fields }
            </ul>
        </div>
    );
}

Node.propTypes = {
    node: PropTypes.object.isRequired,
    containerId: PropTypes.string.isRequired,
    selected: PropTypes.bool.isRequired,
    select: PropTypes.func.isRequired,
    updateNodePosition: PropTypes.func.isRequired,
}

export default Node
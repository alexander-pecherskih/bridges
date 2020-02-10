import React from 'react'

import './styles/node.sass'

const Node = ({ top = 0, left = 0, node }) => {
    const fields = node.fields.map( (field) => {
        return (
            <li className="node__field" key={ field.id }>{ field.name } : { field.type }</li>
        );
    });

    return (
        <div className="node" style={{ top, left }} id={`node-${ node.id }`}>
            <div className="node__title">{ node.name }</div>
            <ul className="node__fields">
                { fields }
            </ul>
        </div>
    );
}

export default Node
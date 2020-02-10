import React from 'react'
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'

import NodeEditor from '../NodeEditor/NodeEditor'

const Toolbar = ({ process }) => {
    return <div>
        <Link to={`/process/${process.id}`} className="btn btn-small">Свойства</Link>
        &nbsp;
        <button className="btn btn-small modal-trigger" data-target="node-editor">Создать узел</button>

        <NodeEditor />
    </div>
}

Toolbar.propTypes = {
    process: PropTypes.object,
}

export default Toolbar
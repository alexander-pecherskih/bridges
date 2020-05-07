import React from 'react'
import PropTypes from 'prop-types'

import './styles/diagram.scss'
import Diagram from './Diagram'

const ProcessEditor = ({ process }) => {
  const nodes = process.nodes
  // const routes = process.routes.filter((item) => {
  //     return item.id !== 'f0ff2129-7ef0-43b5-8714-f3b7eb011971'
  // })
  const routes = process.routes
  // const nodes = process.nodes

  return (
    <>
      <h4>{process.title}</h4>
      <Diagram
        connections={routes}
        nodes={nodes}
        // selectNode={ selectNode }
        // selectedNodeId={ selectedNode ? selectedNode.id : null }
        // updateNodePosition={ updateNodePosition }
      />
    </>
  )
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

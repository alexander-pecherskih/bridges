import React from 'react'
import { nodeType } from './propTypes'

const NodeEditor = ({ node }) => {
  return <div>{node.title}</div>
}

NodeEditor.propTypes = {
  node: nodeType.isRequired,
}

export default NodeEditor

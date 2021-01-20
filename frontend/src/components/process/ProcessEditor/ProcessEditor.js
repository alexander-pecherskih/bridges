import React, { useEffect, useRef, useState } from 'react'
import PropTypes from 'prop-types'

import styles from './styles/diagram.module.css'
import Diagram from './Diagram'
import useWindowSize from '../../../packages/hooks/useWindowSize'

const ProcessEditor = ({ process }) => {
  const { _, height } = useWindowSize()
  const [containerHeight, setContainerHeight] = useState(0)
  const diagramContainerRef = useRef()
  const nodes = process.nodes
  // const routes = process.routes.filter((item) => {
  //     return item.id !== 'f0ff2129-7ef0-43b5-8714-f3b7eb011971'
  // })
  const routes = process.routes
  // const nodes = process.nodes

  useEffect(() => {
    const windowHeight = height ? height : 0
    const containerTop = diagramContainerRef.current.getBoundingClientRect().top + 60
    setContainerHeight(windowHeight - containerTop)
  }, [height, diagramContainerRef.current])

  return (
    <>
      <h4>{process.title}</h4>
      <div className={styles.diagramContainer} style={ { height: containerHeight }} ref={diagramContainerRef}>
        <Diagram
          connections={routes}
          nodes={nodes}
          // selectNode={ selectNode }
          // selectedNodeId={ selectedNode ? selectedNode.id : null }
          // updateNodePosition={ updateNodePosition }
        />
      </div>
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

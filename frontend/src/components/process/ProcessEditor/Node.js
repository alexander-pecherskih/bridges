import React from 'react'
import PropTypes from 'prop-types'

import './styles/node.sass'

class Node extends React.PureComponent {
    state = {
      isDragging: false,
      position: { top: 0, left: 0 },
      screenOffset: { x: 0, y: 0 }
    }

    constructor(props) {
      super(props)
      this.nodeRef = React.createRef()
    }

    handleMouseDown = (e) => {
      const el = this.nodeRef.current
      const screenOffset = {
        x: e.screenX - el.offsetLeft,
        y: e.screenY - el.offsetTop
      }
      this.setState({ isDragging: true, screenOffset })
    }

    handleMouseUp = () => {
      this.setState({ isDragging: false }, () => {
        if (typeof this.props.onDragEnd === 'function') {
          this.props.onDragEnd(this.state.position)
        }
      })
    }

    handleMouseMove = (e) => {
      if (this.state.isDragging) {
        const screen = { x: e.screenX, y: e.screenY }
        this.setState((state) => {
          return {
            position: {
              left: screen.x - state.screenOffset.x,
              top: screen.y - state.screenOffset.y
            }
          }
        }, () => {
          const rect = this.nodeRef.current.getBoundingClientRect()
          this.props.onMove({
            ...this.state.position,
            width: rect.width,
            height: rect.height
          })
        })
      }
    }

    componentDidMount() {
      const { node } = this.props
      this.setState({ position: { ...node.position } }, () => {
        if (typeof this.props.onMove === 'function') {
          const rect = this.nodeRef.current.getBoundingClientRect()
          this.props.onMove({
            ...this.state.position,
            width: rect.width,
            height: rect.height
          })
        }
      })
      document.addEventListener('mousemove', this.handleMouseMove)
    }

    componentWillUnmount() {
      document.removeEventListener('mousemove', this.handleMouseMove)
    }

    render() {
      const { node } = this.props
      const nodeStyle = {
        ...this.state.position,
        userSelect: this.state.isDragging ? 'none' : 'auto'
      }

      return <div
        ref={ this.nodeRef }
        className="node"
        style={ nodeStyle }
      >
        <div className="node__title"
          onMouseDown={ this.handleMouseDown }
          onMouseUp={ this.handleMouseUp }
        >
          { node.title }
        </div>
        <div className="node__fields">
                x: { this.state.position.left }, y: { this.state.position.top }
          <br/>
          { node.id.substring(0, 8) }
        </div>
      </div>
    }
}

Node.propTypes = {
  node: PropTypes.shape({
    id: PropTypes.string.isRequired,
    position: PropTypes.shape({
      top: PropTypes.number,
      left: PropTypes.number
    }).isRequired,
    title: PropTypes.string.isRequired
  }).isRequired,
  onMove: PropTypes.func,
  onDragEnd: PropTypes.func
}

export default Node

import React from 'react'
import PropTypes from 'prop-types'

import './styles/connection.scss'

/**
 * RLT - from Right side (of source) to Left side (of target) when (source at) Top
 * RLB - from Right side (of source) to Left side (of target) when (source at) Bottom
 * ...
 */
const ARRANGEMENT_RLT = 'RLT'
const ARRANGEMENT_RLB = 'RLB'
const ARRANGEMENT_BTR = 'BTR'
const ARRANGEMENT_BTL = 'BTL'
const ARRANGEMENT_LRT = 'LRT'
const ARRANGEMENT_LRB = 'LRB'
const ARRANGEMENT_TBL = 'TBL'
const ARRANGEMENT_TBR = 'TBR'

const OFFSET = 5

const getConnectionArea = (sourceMP, targetMP) => {
  let area = { start: { x: 0, y: 0 }, end: { x: 0, y: 0 } }

  if (sourceMP.right.x < targetMP.left.x) {
    area = {
      start: { x: sourceMP.right.x, y: sourceMP.right.y < targetMP.left.y ? sourceMP.right.y : targetMP.left.y },
      end: { x: targetMP.left.x, y: sourceMP.right.y < targetMP.left.y ? targetMP.right.y : sourceMP.left.y },
      arrangement: sourceMP.right.y < targetMP.left.y ? ARRANGEMENT_RLT : ARRANGEMENT_RLB
    }
  }

  if (sourceMP.right.x >= targetMP.left.x && sourceMP.bottom.y < targetMP.top.y) {
    area = {
      start: { x: sourceMP.bottom.x < targetMP.top.x ? sourceMP.bottom.x : targetMP.top.x, y: sourceMP.bottom.y },
      end: { x: sourceMP.bottom.x < targetMP.top.x ? targetMP.top.x : sourceMP.top.x, y: targetMP.top.y },
      arrangement: sourceMP.bottom.x < targetMP.top.x ? ARRANGEMENT_BTL : ARRANGEMENT_BTR
    }
  }

  if (sourceMP.left.x > targetMP.right.x) {
    area = {
      start: { x: targetMP.right.x, y: sourceMP.left.y < targetMP.right.y ? sourceMP.left.y : targetMP.right.y },
      end: { x: sourceMP.left.x, y: sourceMP.left.y < targetMP.right.y ? targetMP.right.y : sourceMP.left.y },
      arrangement: sourceMP.right.y < targetMP.left.y ? ARRANGEMENT_LRT : ARRANGEMENT_LRB
    }
  }

  if (sourceMP.top.y >= targetMP.bottom.y && sourceMP.right.x > targetMP.left.x && sourceMP.left.x < targetMP.right.x) {
    area = {
      start: { x: targetMP.bottom.x < sourceMP.top.x ? targetMP.bottom.x : sourceMP.top.x, y: targetMP.bottom.y },
      end: { x: targetMP.bottom.x < sourceMP.top.x ? sourceMP.top.x : targetMP.bottom.x, y: sourceMP.top.y },
      arrangement: sourceMP.bottom.x < targetMP.top.x ? ARRANGEMENT_TBL : ARRANGEMENT_TBR
    }
  }

  return {
    ...area, width: Math.abs(area.end.x - area.start.x), height: Math.abs(area.end.y - area.start.y)
  }
}

const getMiddlePoints = (rect) => {
  return {
    top: { x: rect.left + rect.width / 2, y: rect.top },
    right: { x: rect.left + rect.width, y: rect.top + rect.height / 2 },
    bottom: { x: rect.left + rect.width / 2, y: rect.top + rect.height },
    left: { x: rect.left, y: rect.top + rect.height / 2 }
  }
}

const getPathCoordinates = (area) => {
  switch (area.arrangement) {
    case ARRANGEMENT_RLT:
      return {
        start: { x: 0, y: OFFSET },
        end: { x: area.width - OFFSET * 2, y: area.height - OFFSET }
      }
    case ARRANGEMENT_RLB:
      return {
        start: { x: 0, y: area.height - OFFSET },
        end: { x: area.width - OFFSET * 2, y: OFFSET }
      }
    case ARRANGEMENT_BTL:
      return {
        start: { x: OFFSET, y: 0 },
        end: { x: area.width - OFFSET, y: area.height - OFFSET * 2 }
      }
    case ARRANGEMENT_BTR:
      return {
        start: { x: area.width - OFFSET, y: 0 },
        end: { x: OFFSET, y: area.height - OFFSET * 2 }
      }
    case ARRANGEMENT_TBL:
      return {
        start: { x: OFFSET, y: area.height },
        end: { x: area.width - OFFSET, y: OFFSET * 2 }
      }
    case ARRANGEMENT_TBR:
      return {
        start: { x: area.width - OFFSET, y: area.height },
        end: { x: OFFSET, y: OFFSET * 2 }
      }
    case ARRANGEMENT_LRT:
      return {
        start: { x: area.width, y: OFFSET },
        end: { x: OFFSET * 2, y: area.height - OFFSET }
      }
    case ARRANGEMENT_LRB:
      return {
        start: { x: area.width, y: area.height - OFFSET },
        end: { x: OFFSET * 2, y: OFFSET }
      }
    default:
      return { start: { x: 0, y: 0 }, end: { x: 0, y: 0 } }
  }
}

const getControlPoints = (area, start, end) => {
  if ([ARRANGEMENT_BTR, ARRANGEMENT_BTL, ARRANGEMENT_TBR, ARRANGEMENT_TBL].indexOf(area.arrangement) >= 0) {
    return {
      cp1: { x: start.x, y: area.height / 2 },
      cp2: { x: end.x, y: area.height / 2 }
    }
  }

  return {
    cp1: { x: area.width / 2, y: start.y },
    cp2: { x: area.width / 2, y: end.y }
  }
}

const getArrow = (arrangement, x, y, size) => {
  let arrowPath = ''

  switch (arrangement) {
    case ARRANGEMENT_RLT:
    case ARRANGEMENT_RLB:
      // right
      arrowPath = `M ${x + size * 2} ${y} L ${x} ${y - size} L ${x} ${y + size}`
      break
    case ARRANGEMENT_BTL:
    case ARRANGEMENT_BTR:
      // bottom
      arrowPath = `M ${x} ${y + size * 2} L ${x - size} ${y} L ${x + size} ${y}`
      break
    case ARRANGEMENT_LRB:
    case ARRANGEMENT_LRT:
      // left
      arrowPath = `M ${x - size * 2} ${y} L ${x} ${y - size} L ${x} ${y + size}`
      break
    case ARRANGEMENT_TBL:
    case ARRANGEMENT_TBR:
      // top
      arrowPath = `M ${x} ${y - size * 2} L ${x - size} ${y} L ${x + size} ${y}`
      break
    default:
      return null
  }

  return <path d={ arrowPath } fill="gray"/>
}

const getPath = (area) => {
  const { start, end } = getPathCoordinates(area)
  const { cp1, cp2 } = getControlPoints(area, start, end)
  const path = `M ${start.x} ${start.y} C ${cp1.x} ${cp1.y} ${cp2.x} ${cp2.y} ${end.x} ${end.y}`
  const arrow = getArrow(area.arrangement, end.x, end.y, OFFSET)

  return <>
    <path d={ path } fill="none" stroke="gray" strokeWidth="2" />
    { arrow }
  </>
}

class Connection extends React.Component {
  render () {
    const { connection } = this.props
    const sourceRect = connection.source.rect
    const targetRect = connection.target.rect

    if (sourceRect === null || targetRect === null) {
      return null
    }

    const sourceMP = getMiddlePoints(sourceRect)
    const targetMP = getMiddlePoints(targetRect)
    const connectionArea = getConnectionArea(sourceMP, targetMP)
    const connectionStyle = {
      left: connectionArea.start.x,
      top: connectionArea.start.y,
      width: connectionArea.width,
      height: connectionArea.height
    }

    const path = getPath(connectionArea)

    return <svg style={ connectionStyle } className="connection" xmlns="http://www.w3.org/2000/svg">
      { path }
    </svg>
  }
}

const endPointType = PropTypes.shape({
  id: PropTypes.string.isRequired,
  rect: PropTypes.shape({
    top: PropTypes.number,
    left: PropTypes.number,
    height: PropTypes.number,
    width: PropTypes.number
  })
})

Connection.propTypes = {
  connection: PropTypes.shape({
    id: PropTypes.string.isRequired,
    source: endPointType.isRequired,
    target: endPointType.isRequired
  })
}

export default Connection

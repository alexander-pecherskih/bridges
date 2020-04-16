import React from 'react'

import './styles/connection.sass'

const getConnectionRect = (s, t) => {
    return {
        left: s.left + s.width,
        top:  s.top < t.top ? s.top + s.height / 2 : t.top + t.height / 2,
        width: t.left - s.left - t.width,
        height: Math.abs(t.top - s.top)
    }
}

const getPath = (s, t) => {
    const rect = getConnectionRect(s, t)
    const start = { x: 0, y: s.top < t.top ? 0 : rect.height }
    const end   = { x: rect.width, y: s.top < t.top ? rect.height : 0 }
    const cp1 = { x: rect.width / 2, y: start.y }
    const cp2 = { x: rect.width / 2, y: end.y }
    const path = `M ${start.x} ${start.y} C ${cp1.x} ${cp1.y} ${cp2.x} ${cp2.y} ${end.x} ${end.y}`

    return <path d={`${path}`} fill="none" stroke="gray" strokeWidth="2" />
}

class Connection extends React.Component {
    render () {
        const { connection } = this.props
        const sourceRect = connection.source.rect
        const targetRect = connection.target.rect

        if (sourceRect === null || targetRect === null) {
            return null;
        }

        const connectionRect = getConnectionRect(sourceRect, targetRect)
        const connectionStyle = { ...connectionRect }

        const path = getPath(sourceRect, targetRect)

        return <svg style={ connectionStyle } className="connection" xmlns="http://www.w3.org/2000/svg">
            { path }
            {/*<path d={`${path}`} fill="none" stroke="gray" strokeWidth="2" />*/}
            {/*<path d={`M 0 0 C ${connectionStyle.width / 2} 0 ${connectionStyle.width / 2} ${connectionStyle.height} ${connectionStyle.width} ${connectionStyle.height}`}*/}
            {/*      fill="none" stroke="gray" strokeWidth="2" />*/}
            {/*<text x="10" y="10" className="small">{ `source: ${connection.source.id}` }</text>*/}
            {/*<text x="10" y="30" className="small">{ `target: ${connection.target.id}` }</text>*/}
        </svg>
    }
}

export default Connection

/**

 <svg class="connector" style="position:absolute;left:50px;top:50px" width="300" height="300" xmlns="http://www.w3.org/2000/svg">
 <!--   <rect x="0" y="0" width="200" height="200" fill="none" stroke="black" stroke-width="1" /> -->

 <!--   <path d="M 0 0 C 100 0 100 200 200 200"
 fill="none" stroke="gray" stroke-width="2" />
 <path d="M 0 200 C 100 200 100 0 200 0"
 fill="none" stroke="lightgreen" stroke-width="2" /> -->

 <path id="p1" fill="none" stroke="red"  stroke-width="2" stroke-dasharray="10,5" />

 <circle id="endArrow" r="5" fill="red" stroke="none"/>

 <circle id="cp1" r="5" fill="green" stroke="none"/>
 <circle id="cp2" r="5" fill="blue" stroke="none"/>
 </svg>

 */
import React, { useEffect } from 'react'
import M from 'materialize-css'

const NodeEditor = () => {
    useEffect(() => {
        const el = document.querySelectorAll('.node-editor')
        M.Modal.init(el)
    }, [])

    return <div id="node-editor" className="modal node-editor">
        <div className="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
            <p>A bunch of text</p>
            <p>A bunch of text</p>
            <p>A bunch of text</p>
            <p>A bunch of text</p>
            <p>A bunch of text</p>
            <p>A bunch of text</p>
            <p>A bunch of text</p>
            <p>A bunch of text</p>
            <p>A bunch of text</p>

        </div>
        <div className="modal-footer">
            <button className="modal-close btn">Сохранить</button>
            <button className="modal-close btn btn-secondary right-align">Отменить</button>
        </div>
    </div>
}

export default NodeEditor
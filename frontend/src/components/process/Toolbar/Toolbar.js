import React from 'react'
import PropTypes from 'prop-types'
// import { Link } from 'react-router-dom'

const Toolbar = ({ process, nodes, addNode, updateNode }) => {
    const nextId = nodes.length + 1
    const getSelected = () => {
        return nodes.find( item => item.selected )
    }

    return <div>
        {/*<Link to={`/process/${process.id}`} className="btn btn-small">Свойства</Link>*/}
        &nbsp;
        <button
            className="btn-small"
            onClick={ () => addNode(prompt('Введите название узла'), nextId) }
        >Добавить</button>
        &nbsp;
        {/*<button*/}
        {/*    className="btn-small" disabled={ !getSelected() }*/}
        {/*    onClick={ () => console.log('delete') }*/}
        {/*>Удалить</button>*/}
        {/*&nbsp;*/}
        <button
            className="btn-small" disabled={ !getSelected() }
            onClick={ () => updateNode(getSelected().id, prompt('Введите название узла', getSelected().name)) }
        >Переименовать</button>
    </div>
}

Toolbar.propTypes = {
    process: PropTypes.object,
}

export default Toolbar
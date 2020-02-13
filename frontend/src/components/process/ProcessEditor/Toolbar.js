import React from 'react'
import PropTypes from 'prop-types'

import './styles/toolbar.sass'
import Icon from '../../Icon'

const Toolbar = ({ buttons }) => {
    const buttonList = buttons.map( (btn, index) => {
        return <button
            className="toolbar__btn btn-small"
            onClick={ () => btn.handler() }
            disabled={ btn.disabled }
            key={ index }
        >
            { btn.icon ? <Icon icon={btn.icon} className="left"/> : null }
            { btn.label }
        </button>
    })

    return <div className="toolbar">
        { buttonList }
    </div>
}

Toolbar.propTypes = {
    buttons: PropTypes.array.isRequired,
}

export default Toolbar
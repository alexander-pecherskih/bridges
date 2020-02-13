import React, { useEffect, useState } from 'react'
import PropTypes  from 'prop-types'
import M from 'materialize-css'

import Toolbar from './Toolbar'

const ProcessPropsEditor = ({ process, saveProcess }) => {
    const [ p, setProcess ] = useState({ id: process.id, title: process.title })
    useEffect(M.updateTextFields, [p])
    useEffect(() => {
        process === null || setProcess(process)
    }, [process])

    return <>
        <Toolbar
            buttons={ [
                {
                    label: 'Сохранить',
                    handler: () => { saveProcess(p) },
                    icon: 'chevron_left',
                },
            ] }
        />

        {/*<div className="input-field">*/}
        {/*    <input*/}
        {/*        id="id"*/}
        {/*        type="text"*/}
        {/*        className="validate"*/}
        {/*        value={ p.id }*/}
        {/*        onChange={ e => setProcess({ ...p, id: e.target.value }) }*/}
        {/*    />*/}
        {/*    <label htmlFor="id">Id</label>*/}
        {/*</div>*/}
        <div className="input-field">
            <input
                id="title"
                type="text"
                className="validate"
                value={ p.title }
                onChange={ e => setProcess({ ...p, title: e.target.value }) }
            />
            <label htmlFor="title">Title</label>
        </div>
    </>
}

ProcessPropsEditor.propTypes = {
    process: PropTypes.object.isRequired,
    saveProcess: PropTypes.func.isRequired,
}

export default ProcessPropsEditor
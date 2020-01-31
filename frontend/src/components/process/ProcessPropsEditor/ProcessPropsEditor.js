import React, { useEffect, useState } from 'react'
import TextMessage from '../../common/TextMessage'
import M from 'materialize-css'

const ProcessPropsEditor = ({ process, loading, saving, saveProcess }) => {
    const [ p, setProcess ] = useState({ id: '', title: '' })
    useEffect(M.updateTextFields, [p])
    useEffect(() => {
        process === null || setProcess(process)
    }, [process])

    if (loading) {
        return <TextMessage message="Loading..."/>
    }

    return <>
        <div className="input-field">
            <input
                id="id"
                type="text"
                className="validate"
                value={ p.id }
                onChange={ e => setProcess({ ...p, id: e.target.value }) }
            />
            <label htmlFor="id">Id</label>
        </div>
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

        <button
            className="waves-effect waves-light btn"
            onClick={ () => { saveProcess(p) } }
            disabled={ saving }
        >Сохранить</button>
    </>
}

export default ProcessPropsEditor
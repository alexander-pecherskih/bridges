import React from 'react'

import './styles/fields-editor.sass'

const FieldsEditor = ({ node }) => {
    const rows = node.fields.map( item => {
        return <tr key={ item.id }>
            <td>{ item.name }</td>
            <td>{ item.type }</td>
            <td>-</td>
        </tr>
    })
    return <div className="fields-editor">
        <div className="fields-editor__title">{ node.name }</div>
        <table className="fields-editor__table">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Тип</th>
                    <th>Обязательно</th>
                </tr>
            </thead>
            <tbody>
                { rows }
            </tbody>
        </table>
    </div>
}

export default FieldsEditor
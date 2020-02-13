import React from 'react'

import './styles/fields-editor.sass'
import Toolbar from './Toolbar'

const FieldsEditor = ({ node, saveFields }) => {
    const rows = node.fields.map( item => {
        return <tr key={ item.id }>
            <td>{ item.name }</td>
            <td>{ item.type }</td>
            <td>-</td>
        </tr>
    })
    return <>
        <Toolbar
            buttons={ [
                {
                    label: 'Сохранить',
                    handler: () => saveFields([]),
                    icon: 'chevron_left',
                },
                {
                    label: 'Добавить',
                    handler: () => {},
                },
            ] }
        />
        <div className="fields-editor">
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
    </>
}

export default FieldsEditor
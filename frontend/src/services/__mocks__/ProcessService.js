const nodes = [
        {
            id: 1,
            name: 'Узел 1',
            position: { top: 180, left: 20 },
            fields: [
                {id: 1, name: 'Поле 1', type: 'строка'},
                {id: 2, name: 'Поле 2', type: 'число'},
                {id: 3, name: 'Поле 3', type: 'строка'},
                {id: 4, name: 'Поле 4', type: 'строка'},
            ]
        },
        {
            id: 2,
            name: 'Узел 2',
            position: { top: 80, left: 380 },
            fields: [
                {id: 1, name: 'Поле 1', type: 'строка'},
                {id: 2, name: 'Поле 2', type: 'число'},
            ]
        },
        {
            id: 3,
            name: 'Узел 3',
            position: { top: 380, left: 380 },
            fields: [
                {id: 1, name: 'Поле 1', type: 'строка'},
                {id: 4, name: 'Поле 4', type: 'строка'},
            ]
        },
        {
            id: 4,
            name: 'Узел 4',
            position: { top: 230, left: 730 },
            fields: [
                {id: 1, name: 'Поле 1', type: 'строка'},
                {id: 4, name: 'Поле 4', type: 'строка'},
            ]
        },
    ]

const connections = [
    {
        id: 1,
        source_id: 1,
        target_id: 2,
    },
    {
        id: 2,
        source_id: 2,
        target_id: 3,
    },
    {
        id: 3,
        source_id: 2,
        target_id: 4,
    },
]

export const defaultProcessList = [
    {
        id: '1',
        title: 'Process 1',
    },
    {
        id: '2',
        title: 'Process 2',
    },
]

export default {
    getProcesses: () => Promise.resolve(defaultProcessList),

    getProcess: (id) => Promise.resolve({ id: 1, title: 'process 1', nodes, connections }),

    saveProcess: (process) => Promise.resolve(process),
}
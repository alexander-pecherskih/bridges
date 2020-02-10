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
            parent: 1,
            fields: [
                {id: 1, name: 'Поле 1', type: 'строка'},
                {id: 2, name: 'Поле 2', type: 'число'},
            ]
        },
        {
            id: 3,
            name: 'Узел 3',
            position: { top: 380, left: 380 },
            parent: 1,
            fields: [
                {id: 1, name: 'Поле 1', type: 'строка'},
                {id: 4, name: 'Поле 4', type: 'строка'},
            ]
        },
        {
            id: 4,
            name: 'Узел 4',
            position: { top: 230, left: 730 },
            parent: 2,
            fields: [
                {id: 1, name: 'Поле 1', type: 'строка'},
                {id: 4, name: 'Поле 4', type: 'строка'},
            ]
        },
    ];

export default class ProcessService {
    static defaultProcessList = [
        {
            id: '1',
            title: 'Process 1',
        },
        {
            id: '2',
            title: 'Process 2',
        },
    ]

    static getProcesses() {
        return new Promise( (resolve) => {
            setTimeout(() => {
                resolve(this.defaultProcessList)
            }, 1000)
        })
    }

    static getProcess() {
        return new Promise( (resolve) => {
            setTimeout(() => {
                resolve({ id: 1, title: 'process 1', nodes })
            }, 1000)
        })
    }
}
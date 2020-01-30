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
}
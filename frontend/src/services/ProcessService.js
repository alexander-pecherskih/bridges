import Api from './Api'

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

    static getProcesses(accessToken) {
        return Api.fetchWithAuth({ url: '/process' }, accessToken )
            .then((response) => {
                return response.data
            })
            .catch(err => {
                throw new Error(err)
            })
    }

    static getProcess(id, accessToken) {
        return Api.fetchWithAuth({ url: '/process/' + id }, accessToken )
            .then((response) => {
                return response.data
            })
            .catch(err => {
                throw new Error(err)
            })
    }

    static saveProcess(process) {
        return Promise.resolve(process)
    }
}
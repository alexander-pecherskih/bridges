import ProcessService from '../ProcessService'

describe('ProcessService', () => {
    it('fetch one', () => {
        return ProcessService.getProcess()
            .then( data => {
                expect(typeof data).toBe('object')
            })
    })

    it('fetch all', () => {
        return ProcessService.getProcesses()
            .then( data => {
                expect(typeof data).toBe('object')
            })
    })
})
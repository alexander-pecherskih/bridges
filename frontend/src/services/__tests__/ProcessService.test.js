import ProcessService from '../ProcessService'
import Api from '../Api'

jest.mock('../Api')

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

    it('save', () => {
        return ProcessService.saveProcess({})
            .then( (process) => {
                expect(process).toEqual({})
            })
    })
})
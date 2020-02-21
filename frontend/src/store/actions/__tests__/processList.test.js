import configureMockStore from 'redux-mock-store'
import thunk from 'redux-thunk'

import * as actions from '../processList'
import { PROCESS_LIST_REQUEST, PROCESS_LIST_SUCCESS, PROCESS_LIST_FAILURE } from '../../constants/processList'

import { defaultProcessList } from '../../../services/__mocks__/ProcessService'

import ProcessService from '../../../services/ProcessService'
jest.mock('../../../services/ProcessService')

const mockStore = configureMockStore([thunk])

describe('process list get action', () => {
    it('success', () => {
        const store = mockStore({ auth: { accessToken: 'jwt' } })
        const expectedActions = [
            { type: PROCESS_LIST_REQUEST },
            {
                type: PROCESS_LIST_SUCCESS,
                processes: defaultProcessList,
            }
        ]

        return store.dispatch( actions.getProcesses() )
            .then(() => {
                expect(store.getActions()).toMatchObject(expectedActions)
            })
    })

    it('failure', () => {
        const store = mockStore({ auth: { accessToken: 'jwt' } })
        const expectedActions = [
            { type: PROCESS_LIST_REQUEST },
            {
                type: PROCESS_LIST_FAILURE,
                error: { message: 'error' }
            }
        ]

        ProcessService.getProcesses = jest.fn(
            () => Promise.reject({ message: 'error' } )
        )

        return store.dispatch( actions.getProcesses() )
            .then(() => {
                expect(store.getActions()).toEqual(expectedActions)
            })
    })
})

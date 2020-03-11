import configureMockStore from 'redux-mock-store'
import thunk from 'redux-thunk'

import * as actions from '../process'
import { PROCESS_REQUEST, PROCESS_SUCCESS, PROCESS_FAILURE, PROCESS_SAVE } from '../../constants/process'

import ProcessService from '../../../services/ProcessService'
jest.mock('../../../services/ProcessService')

const mockStore = configureMockStore([thunk])

describe('process get action', () => {
    it('success', () => {
        const store = mockStore({ auth: { accessToken: 'jwt' } })
        const expectedActions = [
            { type: PROCESS_REQUEST },
            {
                type: PROCESS_SUCCESS,
                process: { }
            }
        ]

        return store.dispatch( actions.getProcess('process-uuid') )
            .then(() => {
                expect(store.getActions()).toMatchObject(expectedActions)
            })
    })

    it('failure', () => {
        const store = mockStore({ auth: { accessToken: 'jwt' } })
        const expectedActions = [
            { type: PROCESS_REQUEST },
            {
                type: PROCESS_FAILURE,
                error: { message: 'error' }
            }
        ]

        ProcessService.getProcess = jest.fn(
            () => Promise.reject({ message: 'error' } )
        )

        return store.dispatch( actions.getProcess('process-uuid') )
            .then(() => {
                expect(store.getActions()).toEqual(expectedActions)
            })
    })
})

describe('process save action', () => {
    it('success', () => {
        const store = mockStore({ })
        const expectedActions = [
            { type: PROCESS_SAVE },
            { type: PROCESS_SUCCESS }
        ]

        return store.dispatch( actions.saveProcess({ } ) )
            .then(() => {
                expect(store.getActions()).toMatchObject(expectedActions)
            })
    })

    it('failure', () => {
        const store = mockStore({ })
        const expectedActions = [
            { type: PROCESS_SAVE },
            {
                type: PROCESS_FAILURE,
                error: { message: 'error' }
            }
        ]

        ProcessService.saveProcess = jest.fn(
            () => Promise.reject({ message: 'error' } )
        )

        return store.dispatch( actions.saveProcess({ }) )
            .then(() => {
                expect(store.getActions()).toEqual(expectedActions)
            })
    })
})
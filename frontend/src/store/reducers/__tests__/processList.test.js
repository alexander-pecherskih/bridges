import { PROCESS_LIST_REQUEST, PROCESS_LIST_SUCCESS, PROCESS_LIST_FAILURE } from '../../constants/processList'
import { default as reducer, initialState } from '../processList'

describe('process list reducer', () => {
    it(PROCESS_LIST_REQUEST, () => {
        const action = {
            type: PROCESS_LIST_REQUEST,
        }
        expect(reducer(initialState, action)).toEqual({
            ...initialState,
            loading: true,
            processes: [],
        })
    })

    it(PROCESS_LIST_SUCCESS, () => {
        const stateBefore = {
            ...initialState,
            loading: true,
        }
        const action = {
            type: PROCESS_LIST_SUCCESS,
            processes: [1, 2, 3]
        }
        expect(reducer(stateBefore, action)).toEqual({
            ...stateBefore,
            loading: false,
            processes: action.processes,
        })
    })

    it(PROCESS_LIST_FAILURE, () => {
        const stateBefore = {
            ...initialState,
            loading: true,
        }
        const action = {
            type: PROCESS_LIST_FAILURE,
            error: {}
        }
        expect(reducer(stateBefore, action)).toEqual({
            ...stateBefore,
            loading: false,
            processes: [],
            error: action.error
        })
    })


    it('default action', () => {
        expect(reducer(initialState, { type: 'undefined' })).toEqual(initialState)
    })
})
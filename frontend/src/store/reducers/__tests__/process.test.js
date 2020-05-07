import {
  PROCESS_REQUEST,
  PROCESS_SUCCESS,
  PROCESS_FAILURE,
  PROCESS_SAVE,
} from '../../constants/process'
/* eslint-disable-next-line */
import { default as reducer, initialState } from '../process'

describe('process reducer', () => {
  it(PROCESS_REQUEST, () => {
    const action = {
      type: PROCESS_REQUEST,
    }
    expect(reducer(initialState, action)).toEqual({
      ...initialState,
      loading: true,
      process: null,
    })
  })

  it(PROCESS_SUCCESS, () => {
    const stateBefore = {
      ...initialState,
      loading: true,
    }
    const action = {
      type: PROCESS_SUCCESS,
      process: {},
    }
    expect(reducer(stateBefore, action)).toEqual({
      ...stateBefore,
      loading: false,
      process: action.process,
    })
  })

  it(PROCESS_FAILURE, () => {
    const stateBefore = {
      ...initialState,
      loading: true,
      saving: true,
    }
    const action = {
      type: PROCESS_FAILURE,
      process: null,
      error: {},
    }
    expect(reducer(stateBefore, action)).toEqual({
      ...stateBefore,
      loading: false,
      process: action.process,
      error: action.error,
      saving: false,
    })
  })

  it(PROCESS_SAVE, () => {
    const stateBefore = {
      ...initialState,
      loading: false,
      saving: false,
      process: {},
    }
    const action = {
      type: PROCESS_SAVE,
      process: {},
    }
    expect(reducer(stateBefore, action)).toEqual({
      ...stateBefore,
      loading: false,
      process: action.process,
      saving: true,
      error: null,
    })
  })

  it('default action', () => {
    expect(reducer(initialState, { type: 'undefined' })).toEqual(initialState)
  })
})

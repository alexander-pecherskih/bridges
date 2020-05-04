import { AUTH_REQUEST, AUTH_SUCCESS, AUTH_FAILURE, LOGOUT } from '../../constants/auth'
/* eslint-disable-next-line */
import { default as reducer, initialState } from '../auth'

describe('auth reducer', () => {
  it(AUTH_REQUEST, () => {
    const action = {
      type: AUTH_REQUEST
    }

    expect(reducer(initialState, action)).toEqual({
      ...initialState,
      loading: true
    })
  })

  it(AUTH_SUCCESS, () => {
    const stateBefore = {
      ...initialState,
      loading: true
    }
    const action = {
      type: AUTH_SUCCESS,
      accessToken: 'token'
    }

    expect(reducer(stateBefore, action)).toEqual({
      ...stateBefore,
      loading: false,
      authorized: true,
      accessToken: action.accessToken
    })
  })

  it(AUTH_FAILURE, () => {
    const stateBefore = {
      ...initialState
    }
    const action = {
      type: AUTH_FAILURE,
      error: { message: 'Error 500' }
    }

    expect(reducer(stateBefore, action)).toEqual({
      ...stateBefore,
      loading: false,
      authorized: false,
      accessToken: null,
      error: action.error
    })
  })

  it(LOGOUT, () => {
    const stateBefore = {
      ...initialState,
      authorized: true,
      loading: false,
      accessToken: 'token'
    }
    const action = {
      type: LOGOUT
    }

    expect(reducer(stateBefore, action)).toEqual({
      ...stateBefore,
      loading: false,
      authorized: false,
      accessToken: null,
      error: null
    })
  })

  it('default action', () => {
    expect(reducer(initialState, { type: 'undefined' })).toEqual(initialState)
  })
})

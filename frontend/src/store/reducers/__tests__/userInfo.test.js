import { USER_REQUEST, USER_SUCCESS, USER_FAILURE } from '../../constants/user'
/* eslint-disable-next-line */
import { default as reducer, initialState } from '../userInfo'

describe('ticket list reducer', () => {
  it(USER_REQUEST, () => {
    const action = {
      type: USER_REQUEST
    }
    expect(reducer(initialState, action)).toEqual({
      ...initialState,
      loading: true,
      user: null
    })
  })

  it(USER_SUCCESS, () => {
    const stateBefore = {
      ...initialState,
      loading: true
    }
    const action = {
      type: USER_SUCCESS,
      userInfo: {}
    }
    expect(reducer(stateBefore, action)).toEqual({
      ...stateBefore,
      loading: false,
      user: action.userInfo
    })
  })

  it(USER_FAILURE, () => {
    const stateBefore = {
      ...initialState,
      loading: true
    }
    const action = {
      type: USER_FAILURE,
      error: {}
    }
    expect(reducer(stateBefore, action)).toEqual({
      ...stateBefore,
      loading: false,
      user: null,
      error: action.error
    })
  })

  it('default action', () => {
    expect(reducer(initialState, { type: 'undefined' })).toEqual(initialState)
  })
})

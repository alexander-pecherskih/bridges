import configureMockStore from 'redux-mock-store'
import thunk from 'redux-thunk'

import * as actions from '../auth'
import { AUTH_FAILURE, AUTH_REQUEST, AUTH_SUCCESS, LOGOUT } from '../../constants/auth'

import AuthService from '../../../services/AuthService'

jest.mock('../../../services/AuthService')
const mockStore = configureMockStore([thunk])

describe('auth action', () => {
  it('auth success', () => {
    const store = mockStore({ })
    const expectedActions = [
      { type: AUTH_REQUEST },
      {
        type: AUTH_SUCCESS,
        accessToken: 'jwt'
      }
    ]

    return store.dispatch(actions.auth('John', 'pass'))
      .then(() => {
        expect(store.getActions()).toEqual(expectedActions)
      })
  })

  it('auth failure', () => {
    const store = mockStore({ })
    const expectedActions = [
      { type: AUTH_REQUEST },
      {
        type: AUTH_FAILURE,
        error: 'error'
      }
    ]

    return store.dispatch(actions.auth('Silver', 'pass'))
      .then(() => {
        expect(store.getActions()).toEqual(expectedActions)
      })
  })
})

describe('logout action', () => {
  it('success', () => {
    const store = mockStore({ })
    const expectedActions = [
      { type: LOGOUT }
    ]

    store.dispatch(actions.logout())

    expect(store.getActions()).toEqual(expectedActions)
  })

  it('success with redirect', () => {
    const store = mockStore({ })
    const expectedActions = [
      { type: LOGOUT }
    ]

    delete window.location
    window.location = { replace: jest.fn() }

    store.dispatch(actions.logout(true))

    expect(store.getActions()).toEqual(expectedActions)
    expect(window.location.replace).toHaveBeenCalledTimes(1)
  })
})

describe('refresh auth token action', () => {
  it('success', () => {
    const store = mockStore({ })
    const expectedActions = [
      { type: AUTH_REQUEST },
      {
        type: AUTH_SUCCESS,
        accessToken: 'jwt'
      }
    ]

    return store.dispatch(actions.refreshAuthToken())
      .then(() => {
        expect(store.getActions()).toEqual(expectedActions)
      })
  })

  it('failure', () => {
    const store = mockStore({ })
    const expectedActions = [
      { type: AUTH_REQUEST },
      { type: LOGOUT }
    ]

    AuthService.refreshToken = jest.fn(
      /* eslint-disable-next-line */
      () => Promise.reject({ error: { message: 'error' } })
    )

    return store.dispatch(actions.refreshAuthToken())
      .then(() => {
        expect(store.getActions()).toEqual(expectedActions)
      })
  })

  it('invalid token', () => {
    const store = mockStore({ })
    const expectedActions = [
      { type: LOGOUT }
    ]

    AuthService.refreshTokenIsValid = jest.fn(() => false)

    store.dispatch(actions.refreshAuthToken())

    expect(store.getActions()).toEqual(expectedActions)
  })
})

import configureMockStore from 'redux-mock-store'
import thunk from 'redux-thunk'

import * as actions from '../userInfo'
import { USER_REQUEST, USER_SUCCESS, USER_FAILURE } from '../../constants/user'

import { defaultUserInfo } from '../../../services/__mocks__/UserInfoService'

import UserInfoService from '../../../services/UserInfoService'
jest.mock('../../../services/UserInfoService')

const mockStore = configureMockStore([thunk])

describe('user info get action', () => {
  it('success', () => {
    const store = mockStore({ auth: { accessToken: 'jwt' } })
    const expectedActions = [
      { type: USER_REQUEST },
      {
        type: USER_SUCCESS,
        userInfo: defaultUserInfo,
      },
    ]

    return store.dispatch(actions.getUserInfo()).then(() => {
      expect(store.getActions()).toMatchObject(expectedActions)
    })
  })

  it('failure', () => {
    const store = mockStore({ auth: { accessToken: 'jwt' } })
    const expectedActions = [
      { type: USER_REQUEST },
      {
        type: USER_FAILURE,
        error: { message: 'error' },
      },
    ]

    UserInfoService.getInfo = jest.fn(
      /* eslint-disable-next-line */
      () => Promise.reject({ message: 'error' })
    )

    return store.dispatch(actions.getUserInfo()).then(() => {
      expect(store.getActions()).toEqual(expectedActions)
    })
  })
})

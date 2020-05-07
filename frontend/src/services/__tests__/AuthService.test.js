import axios from 'axios'

import '../__mocks__/LocalStorageMock'
import AuthService from '../AuthService'

jest.mock('axios')

const REFRESH_TOKEN_KEY = 'refresh_token'
const REFRESH_TOKEN_VAL = '"token"'
const FETCH_DATA = {
  data: {
    access_token: 'access',
    refresh_token: 'token',
  },
}

describe('AuthService Common', () => {
  it('logout', () => {
    localStorage.setItem(REFRESH_TOKEN_KEY, REFRESH_TOKEN_VAL)

    AuthService.logout()
    expect(localStorage.getItem(REFRESH_TOKEN_KEY)).toBeFalsy()
  })

  it('refresh token is valid', () => {
    localStorage.setItem(REFRESH_TOKEN_KEY, REFRESH_TOKEN_VAL)
    expect(AuthService.refreshTokenIsValid()).toBeTruthy()

    localStorage.clear()
    expect(AuthService.refreshTokenIsValid()).toBeFalsy()
  })
})

describe('AuthService Fetch', () => {
  it('refresh token', async () => {
    localStorage.setItem(REFRESH_TOKEN_KEY, REFRESH_TOKEN_VAL)
    axios.post.mockImplementationOnce(() => Promise.resolve(FETCH_DATA))

    await AuthService.refreshToken()
    expect(axios.post).toHaveBeenCalledTimes(1)
  })

  it('incorrect password', () => {
    localStorage.setItem(REFRESH_TOKEN_KEY, REFRESH_TOKEN_VAL)
    axios.post.mockImplementationOnce(() => Promise.reject(FETCH_DATA))

    return AuthService.refreshToken().catch((e) =>
      expect(e).toEqual(new Error())
    )
  })

  it('access denied', () => {
    localStorage.setItem(REFRESH_TOKEN_KEY, REFRESH_TOKEN_VAL)
    axios.post.mockImplementationOnce(() =>
      Promise.resolve({ data: { access_denied: true } })
    )

    return AuthService.refreshToken().catch((e) =>
      expect(e).toEqual(new Error('Access Denied'))
    )
  })
})

describe('Authorize', () => {
  it('authorize', async () => {
    axios.post.mockImplementationOnce(() => Promise.resolve(FETCH_DATA))

    await AuthService.authorize('John', 'Silver')
    expect(localStorage.getItem(REFRESH_TOKEN_KEY)).toBe(REFRESH_TOKEN_VAL)
  })
})

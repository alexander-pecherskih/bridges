/* eslint-disable-next-line */
import axios from 'axios'
import Api from '../Api'
import AuthService from '../AuthService'

beforeAll(() => {
  delete window.location
  window.location = { replace: jest.fn() }
})

afterAll(() => {
  window.location = location
})

jest.mock('../AuthService', () => ({
  /* eslint-disable-next-line */
  refreshToken: jest.fn().mockReturnValue(new Promise((_, reject) => { reject() })),
  /* eslint-disable-next-line */
  getLoginUrl: jest.fn().mockReturnValue('/login')
}))

jest.mock('jwt-decode', () => jest.fn()
  .mockReturnValueOnce(false)
  .mockReturnValueOnce({
    exp: Date.now() / 1000 - 100
  })
  .mockReturnValue({
    exp: Date.now() / 1000 + 100
  })
)

jest.mock('axios')

const ACCESS_TOKEN = 'token'
// const FETCH_DATA = { data: 'USER_INFO' }

describe('API', () => {
  it('undefined token', async () => {
    await Api.fetchWithAuth({})
    expect(window.location.replace).toHaveBeenCalledTimes(1)
  })

  it('undefined token', async () => {
    await Api.fetchWithAuth({}, ACCESS_TOKEN)
    expect(window.location.replace).toHaveBeenCalledTimes(2)
  })

  it('expired token', async () => {
    await Api.fetchWithAuth({}, ACCESS_TOKEN)
    expect(AuthService.refreshToken).toHaveBeenCalledTimes(1)
  })

  // it('fetch', async () => {
  //     axios.mockImplementationOnce(() => Promise.resolve(FETCH_DATA))
  //
  //     await Api.fetchWithAuth({ url: '/user-info' }, ACCESS_TOKEN)
  //     expect(axios).toHaveBeenCalledTimes(1)
  // })
})

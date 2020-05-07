import UserInfoService from '../UserInfoService'
import Api from '../Api'

jest.mock('../Api')

const promiseResolve = (resolve) => {
  resolve({ data: { user: 'John' } })
}
const promiseReject = (_, reject) => {
  reject(new Error('error'))
}

describe('UserInfoService', () => {
  it('fetch', () => {
    const mockFetchWithAuth = jest
      .fn()
      .mockReturnValue(new Promise(promiseResolve))
    Api.fetchWithAuth = mockFetchWithAuth.bind(Api)

    return UserInfoService.getInfo('UserInfoTest').then((data) => {
      expect(typeof data).toBe('object')
    })
  })

  it('catch', () => {
    const mockFetchWithAuth = jest
      .fn()
      .mockReturnValue(new Promise(promiseReject))
    Api.fetchWithAuth = mockFetchWithAuth.bind(Api)

    return UserInfoService.getInfo('UserInfoTest').catch((err) => {
      expect(typeof err).toBe('object')
    })
  })
})

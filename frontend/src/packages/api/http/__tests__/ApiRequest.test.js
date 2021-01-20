import ApiRequest from '../ApiRequest'
import axios from 'axios'
import MockAdapter from 'axios-mock-adapter'

describe('ApiRequest', () => {
  let mock, api
  const LOGIN_RESPONSE = {
    access_token: 'ACCESS TOKEN',
    refresh_token: 'REFRESH TOKEN'
  }

  const REFRESH_RESPONSE = {
    access_token: 'ACCESS TOKEN2',
    refresh_token: 'REFRESH TOKEN2'
  }

  const { location } = window

  beforeAll(() => {
    delete window.location
    window.location = { replace: jest.fn() }
  })

  afterAll(() => {
    window.location = location
  })

  beforeEach(() => {
    const client = axios.create()
    mock = new MockAdapter(client)
    api = new ApiRequest({ client, loginURL: '/auth/login', refreshURL: '/auth/refresh' })
  })

  it('login', async () => {
    mock.onPost('/auth/login').reply(200, LOGIN_RESPONSE)
    mock.onGet('/trololo').reply(200, [])

    await api.login('user', 'pass')
    await api.request({ method: 'get', url: '/trololo'})
    expect(mock.history.post.length).toEqual(1)
    expect(mock.history.post[0].headers['Content-Type']).toEqual(`multipart/form-data`)
    expect(mock.history.get.length).toEqual(1)
    expect(mock.history.get[0].headers.Authorization).toEqual(`Bearer ${LOGIN_RESPONSE.access_token}`)
  })

  it('logout', async () => {
    mock.onPost('/auth/login').reply(200, LOGIN_RESPONSE)
    mock.onGet('/trololo').reply(200, [])

    await api.login('user', 'pass')
    api.logout()
    await api.request({ method: 'get', url: '/trololo'})

    expect(mock.history.get[0].headers.Authorization).toBeFalsy()
  })

  it('refresh', async () => {
    mock.onPost('/auth/login').reply(200, LOGIN_RESPONSE)
    mock.onPost('/auth/refresh').reply(200, REFRESH_RESPONSE)
    mock.onGet('/trololo').reply((config) => {
      const { Authorization: auth } = config.headers
      if (auth === `Bearer ${LOGIN_RESPONSE.access_token}`) {
        return [401]
      }
      if (auth === `Bearer ${REFRESH_RESPONSE.access_token}`) {
        return [200, []]
      }
      return [404]
    })

    await api.login('user', 'pass')
    await api.request({ method: 'get', url: '/trololo'})

    expect(mock.history.post[1].headers['Content-Type']).toEqual(`multipart/form-data`)

    expect(mock.history.get.length).toEqual(2)
    expect(mock.history.get[1].headers.Authorization).toEqual(`Bearer ${REFRESH_RESPONSE.access_token}`)
  })

  it('redirect after refresh', async () => {
    mock.onPost('/auth/login').reply(200, LOGIN_RESPONSE)
    mock.onPost('/auth/refresh').reply(401, REFRESH_RESPONSE)
    mock.onGet('/trololo').reply(401)

    await api.login('user', 'pass')
    try {
      await api.request({ method: 'get', url: '/trololo' })
    } catch ( e ) {}

    expect(window.location.replace).toHaveBeenCalledTimes(1)
  })

  it('non 401 on request', async () => {
    mock.onGet('/trololo').reply(404, [])

    await expect(api.request({ method: 'get', url: '/trololo'}))
      .rejects
      .toMatchObject({status: 404})
  })

  it('non duplicated refresh', async () => {
    mock.onPost('/auth/login').reply(200, LOGIN_RESPONSE)
    mock.onPost('/auth/refresh').replyOnce(200, REFRESH_RESPONSE)
    mock.onGet('/trololo').reply((config) => {
      const { Authorization: auth } = config.headers
      if (auth === `Bearer ${LOGIN_RESPONSE.access_token}`) {
        return [401]
      }
      if (auth === `Bearer ${REFRESH_RESPONSE.access_token}`) {
        return [200, []]
      }
      return [404]
    })

    await api.login('user', 'pass')
    await Promise.all([
      api.request({ method: 'get', url: '/trololo'}),
      api.request({ method: 'get', url: '/trololo'})
    ])

    expect(mock.history.post.filter(({ url }) => url === '/auth/refresh').length).toEqual(1)
  })
})

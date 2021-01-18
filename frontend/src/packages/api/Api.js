import ApiRequest from './http/ApiRequest'
import ProcessRepository from './rest/process/ProcessRepository'

const ACCESS_TOKEN_KEY = 'access_token'
const REFRESH_TOKEN_KEY = 'refresh_token'

class TokenStorage {
  static get() {
    return {
      accessToken: localStorage.getItem(ACCESS_TOKEN_KEY),
      refreshToken: localStorage.getItem(REFRESH_TOKEN_KEY),
    }
  }

  static set(accessToken, refreshToken) {
    localStorage.setItem(ACCESS_TOKEN_KEY, accessToken)
    localStorage.setItem(REFRESH_TOKEN_KEY, refreshToken)
  }

  static reset() {
    localStorage.removeItem(ACCESS_TOKEN_KEY)
    localStorage.removeItem(REFRESH_TOKEN_KEY)
  }
}

export default class Api {
  constructor() {
    const { accessToken, refreshToken } = TokenStorage.get()

    this.apiRequest = new ApiRequest({
      accessToken, refreshToken,
      baseURL: 'http://api.bridges.local'
    })

    this.processRepository = new ProcessRepository(this.request)
  }

  get request() {
    return this.apiRequest
  }

  isAuthorized() {
    const { accessToken } = TokenStorage.get()

    return accessToken !== undefined && accessToken !== null
  }

  login(username, password) {
    return this.request.login(username, password).then(({ accessToken, refreshToken }) => {
      TokenStorage.set(accessToken, refreshToken)
    })
  }

  logout() {
    this.request.logout()

    TokenStorage.reset()
  }
}

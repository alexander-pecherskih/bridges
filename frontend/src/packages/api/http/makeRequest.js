import HttpRequest from './HttpRequest'
import * as token  from '../rest/authorization/token'

const makeRequest = (options) => {
  options.auth = options.auth === undefined ? true : options.auth
  const http = new HttpRequest({
    token: options.auth ? token.get('access_token') : null,
    refreshToken: options.auth ? token.get('refresh_token') : null,
    baseUrl: 'http://api.bridges.local'
  })

  return http.send(options)
}

export default makeRequest

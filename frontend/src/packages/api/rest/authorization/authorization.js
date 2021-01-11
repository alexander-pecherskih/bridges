import makeRequest from '../../http/makeRequest'
import * as token from './token'

export const login = (username, password) => {
  return makeRequest({
    url: '/token',
    method: 'post',
    data: {
      username,
      password,
      grant_type: 'password',
      client_id: 'app',
      client_secret: 'secret',
    },
    headers: { 'Content-Type': 'multipart/form-data' },
    formData: true,
    auth: false,
  }).then((response) => {
    if (
      !Object.prototype.hasOwnProperty.call(response.data, 'access_token') ||
      !Object.prototype.hasOwnProperty.call(response.data, 'refresh_token')
    ) {
      throw new Error('Access Denied')
    }

    token.set('access_token', response.data.access_token)
    token.set('refresh_token', response.data.refresh_token)
    return { accessToken: response.data.access_token, refreshToken: response.data.refresh_token }
  })
}

export const logout = () => {
  token.remove('access_token')
  token.remove('refresh_token')
}
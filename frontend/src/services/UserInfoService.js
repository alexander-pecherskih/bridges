import Api from './Api'

export default class UserInfoService {
  static getInfo(accessToken) {
    return Api.fetchWithAuth({ url: '/user-info' }, accessToken)
      .then((response) => {
        return response.data
      })
      .catch(err => {
        throw new Error(err)
      })
  }
}

import Api from './Api'

export default class UserInfoService {
    static defaultUserInfo = {
        id: '0000000000',
        email: 'confirmed@bridges.local',
        name: 'John',
        surname: 'Silver',
        avatar: '/images/avatar.jpg',
    }

    static getInfo() {
        return Api.fetchWithAuth({ url: '/user-info' })
            .then((response) => {
                return response.data
            })
            .catch((err) => {
                throw new Error(err)
            })
    }
}
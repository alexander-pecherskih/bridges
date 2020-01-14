export default class UserInfoService {
    static defaultUserInfo = {
        id: '0000000000',
        email: 'confirmed@bridges.local',
        name: 'John',
        surname: 'Silver',
        avatar: '/images/avatar.jpg',
    }
    static getInfo() {
        return new Promise( (resolve) => {
            setTimeout(() => {
                resolve(this.defaultUserInfo)
            }, 1000)
        })
    }
}
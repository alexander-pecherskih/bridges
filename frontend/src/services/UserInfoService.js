export default class UserInfoService {
    static defaultUserInfo = {
        id: 0,
        email: 'confirmed@bridges.local',
        name: 'John',
        surname: 'Silver',
        avatar: '/images/avatar.jpg',
    }
    static getInfo() {
        return new Promise( (resolve) => {
            setTimeout(() => {
                // console.log('USERINFO LOADED')
                resolve(this.defaultUserInfo)
            }, 1000)
        })
    }
}
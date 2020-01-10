const IDENTITY_KEY = 'identity'

export default class AuthService {
    defaultIdentity = {
        user: 'John',
        token: 'trololo',
    }

    getIdentity = () => {
        const identity = AuthService.getIdentityFromLocalStorage()

        if (identity !== null) {
            return new Promise( resolve => {
                resolve(identity)
            })
        }

        return new Promise((resolve/*, reject*/) => {
            setTimeout(() => {
                AuthService.saveIdentityToLocalStorage(this.defaultIdentity)
                resolve(this.defaultIdentity)
            },1000);
        });
    }

    static getIdentityFromLocalStorage = () => {
        const identityString = localStorage.getItem(IDENTITY_KEY)

        return JSON.parse(identityString) || null
    }

    static saveIdentityToLocalStorage = (identity) => {
        localStorage.setItem(IDENTITY_KEY, JSON.stringify(identity))
    }

    static removeIdentityFromLocalStorage = () => {
        localStorage.removeItem(IDENTITY_KEY)
    }
}
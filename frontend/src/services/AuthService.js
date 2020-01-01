export default class AuthService {
    identity = {
        username: 'John',
        token: 'trololo'
    }

    getIdentity = () => {
        return new Promise((resolve/*, reject*/) => {
            setTimeout(() => {
                resolve(this.identity);
            },1000);
        });
    }
}
export const defaultUserInfo = {
    id: 'uuid',
    name: 'John',
}

export default  {
    getInfo: () => Promise.resolve(defaultUserInfo)
}
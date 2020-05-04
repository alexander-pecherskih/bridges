import getPageTitle from '../getPageTitle'

describe('getPageTitle function', () => {
  it('home', () => {
    expect(getPageTitle('/')).toEqual('Главная :: The Bridge')
  })
  it('/process', () => {
    expect(getPageTitle('/process/1')).toEqual('Редактор процесса :: The Bridge')
  })
  it('Title not found', () => {
    expect(getPageTitle('/title-not-found')).toEqual('The Bridge')
  })
  it('Without project name', () => {
    expect(getPageTitle('/process/1', false)).toEqual('Редактор процесса')
  })
})

import LoginPage from './LoginPage'
import HomePage from './HomePage'
import SettingsPage from './SettingsPage'
import ProfilePage from './ProfilePage'
import ProcessesPage from './ProcessesPage'
import ProcessPage from './ProcessPage'
import DiagramPage from './DiagramPage'

const PROJECT_NAME = 'The Bridge'
const pages = [
    {
        path: /^\/$/,
        title: 'Главная',
    },
    {
        path: '/settings',
        title: 'Настройки',
    },
    {
        path: '/profile',
        title: 'Настройки пользователя',
    },
    {
        path: '/processes',
        title: 'Процессы',
    },
    {
        path: /\/process\/\d+/,
        title: 'Параметры процесса',
    },
    {
        path: /\/diagram\/\d+/,
        title: 'Схема процесса',
    },
]

const getPageTitle = (path, withProjectName = true) => {
    const page = pages.find((item) => {
        return (item.path instanceof RegExp && path.search(item.path) !== -1)
            || path === item.path
    })
    const projectName = withProjectName ? PROJECT_NAME : ''
    const divider = withProjectName ? ' :: ' : ''

    if (!page) {
        return projectName
    }

    return `${page.title}${divider}${projectName}`
}

export { LoginPage, HomePage, SettingsPage, ProfilePage, ProcessesPage, ProcessPage, DiagramPage }

export { getPageTitle }
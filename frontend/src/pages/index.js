import LoginPage from './LoginPage'
import HomePage from './HomePage'
import SettingsPage from './SettingsPage'
import ProfilePage from './ProfilePage'
import ProcessesPage from './ProcessesPage'
import ProcessEditorPage from './ProcessEditorPage'

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
        title: 'Редактор процесса',
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

export { LoginPage, HomePage, SettingsPage, ProfilePage, ProcessesPage, ProcessEditorPage }

export { getPageTitle }
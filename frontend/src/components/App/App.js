import React from 'react'
import {Switch, Route } from 'react-router-dom'

import Header from '../Header'
import Footer from '../Footer'
import { HomePage, ProcessesPage, ProfilePage, SettingsPage } from '../../pages'

const App = ({ identity, logout }) => {
    return <>
        <Header identity={ identity } logout={ logout }/>
            <main>
                <div className="main-container">
                    <Switch>
                        <Route exact path="/" component={ HomePage } />
                        <Route path="/settings" component={ SettingsPage } />
                        <Route path="/profile" component={ ProfilePage } />
                        <Route path="/processes" component={ ProcessesPage } />
                    </Switch>
                </div>
            </main>
        <Footer />
    </>
}

export default App

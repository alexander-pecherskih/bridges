import React from 'react'
import PropTypes from 'prop-types'
import { Switch, Route } from 'react-router-dom'

import Header from '../Header'
import Footer from '../Footer'
import { HomePage, ProcessesPage, ProfilePage, SettingsPage, ProcessEditorPage } from '../../pages'

const App = ({ logout }) => {
  return <>
    <Header logout={ logout }/>
    <main>
      <div className="main-container">
        <Switch>
          <Route exact path="/" component={ HomePage } />
          <Route path="/settings" component={ SettingsPage } />
          <Route path="/profile" component={ ProfilePage } />
          <Route path="/processes" component={ ProcessesPage } />
          <Route path="/process/:id" component={ ProcessEditorPage } />
        </Switch>
      </div>
    </main>
    <Footer />
  </>
}

App.propTypes = {
  logout: PropTypes.func
}

export default App

import React from 'react'

import { HomePage, LoginPage, LogoutPage, NotFoundPage, ProcessListPage } from '../pages'
import { Switch, Route } from 'react-router-dom'
import ProtectedRoute from '../ProtectedRoute/ProtectedRoute'

const App = () => {
  return (
    <Switch>
      <ProtectedRoute exact path="/" component={HomePage} />
      <ProtectedRoute path="/process-list" component={ProcessListPage} />
      <Route path="/logout" component={LogoutPage} />
      <Route path="/login" component={LoginPage} />
      <Route path="*" component={NotFoundPage} />
    </Switch>
  )
}

export default App

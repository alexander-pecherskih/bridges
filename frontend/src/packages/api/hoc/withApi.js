import React from 'react'
import { ApiConsumer } from './ApiContext'

const getDisplayName = (WrappedComponent) => {
  return WrappedComponent.displayName || WrappedComponent.name || 'Component'
}

const withApi = () => (Wrapped) => {
  const withApi = (props) => {
    return (
      <ApiConsumer>
        {(api) => {
          return <Wrapped {...props} api={api} />
        }}
      </ApiConsumer>
    )
  }
  withApi.displayName = `withApi(${getDisplayName(Wrapped)})`

  return withApi
}

withApi.displayName = 'withApi'

export default withApi

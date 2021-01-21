import React from 'react'

const { Provider: ApiProvider, Consumer: ApiConsumer } = React.createContext(
  undefined
)

export { ApiProvider, ApiConsumer }

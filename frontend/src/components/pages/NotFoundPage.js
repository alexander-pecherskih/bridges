import React from 'react'
import CenteredLayout from '../layouts/CenteredLayout'
import { Link } from 'react-router-dom'

const NotFoundPage = () => {
  return (
    <CenteredLayout>
      <div>
        <h1>Error 404. Page not found.</h1>
        <Link to="/">Back to Home</Link>
      </div>
    </CenteredLayout>
  )
}

export default NotFoundPage

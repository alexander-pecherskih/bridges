import React from 'react'
import DefaultLayout from '../layouts/DefaultLayout'
import ProcessListContainer from '../process/ProcessList/ProcessListContainer'
import Card from '../ui/Card'

const ProcessListPage = () => {
  return <DefaultLayout>
    <Card>
      <ProcessListContainer />
    </Card>
  </DefaultLayout>
}

export default ProcessListPage
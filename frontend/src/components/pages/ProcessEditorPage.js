import React from 'react'
import DefaultLayout from '../layouts/DefaultLayout'
import Card from '../ui/Card'
import ProcessEditorContainer from '../process/ProcessEditor/ProcessEditorContainer'

const ProcessEditorPage = () => {
  return (
    <DefaultLayout>
      <Card>
        <ProcessEditorContainer />
      </Card>
    </DefaultLayout>
  )
}

export default ProcessEditorPage

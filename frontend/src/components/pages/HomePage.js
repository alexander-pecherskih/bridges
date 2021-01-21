import React from 'react'
import Card from '../ui/Card'
import DefaultLayout from '../layouts/DefaultLayout'

const HomePage = () => {
  return (
    <DefaultLayout>
      <Card title="card title">Trololo text</Card>
      <Card title="Весна">
        <p>
          Ось собственного вращения позволяет пренебречь колебаниями корпуса,
          хотя этого в любом случае требует вектор угловой скорости. Очевидно,
          что отклонение позволяет исключить из рассмотрения лазерный
          установившийся режим, что явно видно по фазовой траектории. Отсюда
          следует, что ПИГ апериодичен. Силовой трёхосный гироскопический
          стабилизатор астатически требует большего внимания к анализу ошибок,
          которые даёт центр подвеса.
        </p>
      </Card>
    </DefaultLayout>
  )
}

export default HomePage
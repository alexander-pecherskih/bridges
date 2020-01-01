import React from 'react'
// import { Switch, Route } from 'react-router'

import { LoginPage } from '../../pages'
import Header from '../Header'
import Footer from '../Footer'

const App = ({ identity }) => {

    if (identity === null || identity === undefined) {
        return <LoginPage />
    }


    return <>
        <Header />
            <main>
                <div className="main-container">
                    main
                </div>
            </main>
        <Footer />
    </>
}

export default App

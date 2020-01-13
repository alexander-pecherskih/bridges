import React from 'react'
// import { Switch, Route } from 'react-router'

import Header from '../Header'
import Footer from '../Footer'

const App = ({ identity, logout }) => {
    return <>
        <Header identity={ identity } logout={ logout }/>
            <main>
                <div className="main-container">
                    main
                </div>
            </main>
        <Footer />
    </>
}

export default App

import React from 'react'

const Footer = () => {
    const year = (new Date()).getFullYear()

    return (
        <footer className="footer">
            <div className="main-container">
                &copy; { year }
            </div>
        </footer>
    )
}

export default Footer
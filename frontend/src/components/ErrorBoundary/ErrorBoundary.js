import React from 'react';

export default class ErrorBoundary extends React.Component {
    state = {
        hasError: false,
    };

    static getDerivedStateFromError(error) {
        return {
            hasError: true,
        }
    }

    render() {
        if (this.state.hasError) {
            return <div>Что-то пошло не так :(</div>;
        }

        return this.props.children;
    }
}

import React, { Component } from 'react';
import {Provider} from 'react-redux';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';

import store from './store';
import saga from './sagas/'
import { sagaMiddleware } from './middleware'

import Home from './containers/Home/index'





class App extends Component {
  render() {
    return (
      <Provider store={store}>
        <Router>
          <Route path="/" component={Home}/>
        </Router>
      </Provider>
    );
  }
}

export default App;

// sagaMiddleware.run(saga)

import React, { Component } from 'react';
import {BrowserRouter, Route, Switch} from 'react-router-dom'
import TopNavigation from './TopNavigation'
import Products from './Products'
import Cart from './Cart'

class Store extends Component {
  render() {
    return (
       <BrowserRouter>
            <div className="App">

              <TopNavigation/>
                <Switch>
                    <Route exact path="/" component={Products}/>
                    <Route path="/cart" component={Cart}/>
                  </Switch>
             </div>
       </BrowserRouter>

    );
  }
}

export default Store;

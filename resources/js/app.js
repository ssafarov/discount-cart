import React from 'react';
import ReactDOM from 'react-dom';
import Store from './components/Store';
import './index.css'
import cartReducer from './components/reducers/cartReducer';
import { Provider } from 'react-redux';
import { createStore } from 'redux';

const store = createStore(cartReducer);

ReactDOM.render(<Provider store={store}><Store /></Provider>, document.getElementById('store-root'));


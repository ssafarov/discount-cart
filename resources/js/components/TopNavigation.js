import React from 'react';
import {Link} from 'react-router-dom'

const TopNavigation = () => {
    return (
        <nav className="nav-wrapper">
            <div className="container">
                <Link to="/" className="brand-logo">Mega Shopping</Link>

                <ul className="right">
                    <li><Link to="/">Discount constructor</Link></li>
                    <li><Link to="/">Product List</Link></li>
                    <li><Link to="/cart"><i className="material-icons">shopping_cart</i></Link></li>
                </ul>
            </div>
        </nav>
    )
}

export default TopNavigation;

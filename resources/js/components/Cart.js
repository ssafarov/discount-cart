import React, {Component} from 'react';
import {connect} from 'react-redux'
import {Link} from 'react-router-dom'
import {addQuantity, removeItem, subtractQuantity} from './actions/cartActions'
import Coupon from './Coupon'

class Cart extends Component {

    //to remove the item completely
    handleRemove = (id) => {
        this.props.removeItem(id);
    };

    //to add the quantity
    handleAddQuantity = (id) => {
        this.props.addQuantity(id);
    };

    //to substruct from the quantity
    handleSubtractQuantity = (id) => {
        this.props.subtractQuantity(id);
    };

    render() {

        let addedItems = this.props.items.length ?
            (
                this.props.items.map(item => {
                    return (
                        <tr key={item.id}>
                            <td>{item.title}</td>
                            <td>{item.desc}</td>
                            <td>${item.price}</td>
                            <td>{item.quantity}</td>
                            <td>
                                <Link to="/cart"><i className="material-icons" onClick={() => {
                                    this.handleAddQuantity(item.id)
                                }}>arrow_drop_up</i></Link>
                                <Link to="/cart"><i className="material-icons" onClick={() => {
                                    this.handleSubtractQuantity(item.id)
                                }}>arrow_drop_down</i></Link>
                            </td>
                            <td>
                                <button className="waves-effect waves-light btn pink remove" onClick={() => {
                                    this.handleRemove(item.id)
                                }}>Remove
                                </button>
                            </td>
                        </tr>

                    )
                })
            ) :

            (
                <tr>
                    <td colSpan={6}>Cart empty</td>
                </tr>
            );

        return (
            <div className="container">
                <div className="cart">
                    <h5>You have added following items to the cart:</h5>
                    <table>
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th colSpan={2}>Quantity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {addedItems}
                        </tbody>
                    </table>
                </div>
                <Coupon/>
            </div>
        )
    }
}


const mapStateToProps = (state) => {
    return {
        items: state.addedItems,
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        removeItem: (id) => {
            dispatch(removeItem(id))
        },
        addQuantity: (id) => {
            dispatch(addQuantity(id))
        },
        subtractQuantity: (id) => {
            dispatch(subtractQuantity(id))
        }
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(Cart)

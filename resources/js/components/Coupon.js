import React, {Component} from 'react'
import {connect} from 'react-redux'


class Coupon extends Component {

    constructor(props) {
        super(props);

        this.state = {
            coupon: ''
        };

        this.updateInput = this.updateInput.bind(this);
        this.handleCoupon = this.handleCoupon.bind(this);
    }

    updateInput(event) {
        this.setState({coupon: event.target.value})
    }

    handleCoupon = (e) => {
        console.log('Your coupon value is: ' + this.state.coupon)

        // if (e.target.checked) {
        //     this.props.addCoupon();
        // } else {
        //     this.props.substractCoupon();
        // }
    };

    render() {

        return (
            <div className="cart">
                <div className="box">
                    <div className="row">
                        <label>
                            <span>Coupon:</span>
                            <input type="text" onChange={this.updateInput}/>
                        </label>
                        <button className="btn btn-primary" onClick={this.handleCoupon}>Apply Coupon</button>
                    </div>
                </div>
                <div className="total">
                    <p><b>Total: ${this.props.total}</b></p>
                </div>
                <div className="checkout">
                    <button className="waves-effect waves-light btn">Checkout</button>
                </div>
            </div>
        )
    }
}

const mapStateToProps = (state) => {
    return {
        addedItems: state.addedItems,
        total: state.total
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        addCoupon: () => {
            dispatch({type: 'ADD_COUPON'})
        },
        substractCoupon: () => {
            dispatch({type: 'SUB_COUPON'})
        }
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(Coupon)

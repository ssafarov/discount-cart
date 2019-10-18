import React, {Component} from 'react'
import {connect} from 'react-redux'
import axiosInstance from "../api/axiosInstance";

class Coupon extends Component {

    constructor(props) {
        super(props);

        this.state = {
            coupon: '',
            message: '',
            total: props.total
        };

        this.updateInput = this.updateInput.bind(this);
        this.handleCoupon = this.handleCoupon.bind(this);
    }

    updateInput(event) {
        this.setState({coupon: event.target.value})
    }

    handleCoupon = (e) => {
        // Let request API for current coupon situation
        const headers = {Accept: "application/json"};
        const data = {
            'total': this.props.total,
            'amount': this.props.addedItems.length,
            'coupon': this.state.coupon,
            'cartid': '39e7062f-fa31-480a-aaf1-a534e2541381'
        };

        axiosInstance.post('api/checkcoupon', data, {headers: headers})
            .then((response) => {
                this.setState({coupon: '', total: response.data, message: 'Coupon ' + this.state.coupon + ' applied successfully!'});
            })
            .catch((error,response) => {
                this.setState({coupon: '', message: error.response.data});
            });
    };

    clearCoupon = (e) => {
        // Let request API for current coupon situation
        const headers = {Accept: "application/json"};
        const data = {
            'cartid': '39e7062f-fa31-480a-aaf1-a534e2541381'
        };

        axiosInstance.post('api/removecoupon', data, {headers: headers})
            .then((response) => {
                this.setState({coupon: '', total: response.data, message: 'Coupon was successfully removed from cart!'});
            })
            .catch((error,response) => {
                this.setState({coupon: '', message: error.response.data});
            });
    };

    shouldComponentUpdate(nextProps, nextState){
        return this.state.message !== nextState.message ||
            this.state.total !== nextState.total;

    };

    componentWillUpdate(nextProps, nextState) {
        this.render();
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
                        <button className="btn btn-primary" onClick={this.handleCoupon}>Apply Coupon</button>&nbsp;
                        <button className="btn btn-primary" onClick={this.clearCoupon}>Remove Coupon</button>
                    </div>
                </div>
                <div className="total">
                    <p><b>Total: ${this.state.total}</b></p>
                    <p><b>{this.state.message}</b></p>
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

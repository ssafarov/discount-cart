import React, {Component} from 'react';
import {connect} from 'react-redux'
import {addToCart} from './actions/cartActions'

class Products extends Component {

    // componentDidMount() {
    //     // initial load, check if user is logged in
    //     const headers = {Accept: "application/json"};
    //
    //     axios.get('api/products', {headers})
    //         .then((response) => {
    //             console.log(response);
    //             const products = response.data;
    //             console.log(products);
    //             console.log(this.props.items);
    //             products.map((product) => {
    //                 this.props.items.push(
    //                     {
    //                         id: product.uuid,
    //                         title: product.title,
    //                         desc: product.description,
    //                         price: product.price
    //                     })
    //             });
    //             console.log(this.props.items);
    //         })
    //         .catch((error) => {
    //             console.log(error);
    //             this.props.items = [];
    //         });
    // }

    handleClick = (id) => {
        this.props.addToCart(id);
    };

    render() {
        let itemList = this.props.items.length ?
            (
                this.props.items.map(item => {
                    return (
                        <tr key={item.id}>
                            <td>{item.title}</td>
                            <td>{item.desc}</td>
                            <td>${item.price}</td>
                            <td>
                                <button className="small waves-effect waves-light btn btn-primary" onClick={() => {
                                    this.handleClick(item.id)
                                }}>Add to cart
                                </button>
                            </td>
                        </tr>
                    )
                })
            ) :
            (
                <tr>
                    <td colSpan={4}>Product list empty</td>
                </tr>
            );

        return (
            <div className="container">
                <h3 className="center">Product list</h3>
                <div className="box">
                    <table>
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {itemList}
                        </tbody>
                    </table>
                </div>
            </div>
        )
    }
}

const mapStateToProps = (state) => {
    return {
        items: state.items
    }
};

const mapDispatchToProps = (dispatch) => {

    return {
        addToCart: (id) => {
            dispatch(addToCart(id))
        }
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(Products)

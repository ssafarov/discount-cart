
import {ADD_QUANTITY, ADD_COUPON, ADD_TO_CART, REMOVE_ITEM, SUB_QUANTITY} from '../actions/action-types/cart-actions'


let initState = {
    items: [
        {id:1,title:'Product 1', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price: 110.00},
        {id:2,title:'Product 2', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price: 80.45},
        {id:3,title:'Product 3', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price: 120.49},
        {id:4,title:'Product 4', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price: 260.32},
        {id:5,title:'Product 5', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price: 160.77},
        {id:6,title:'Product 6', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price: 190.00},
        {id:7,title:'Product 7', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price: 9.99},
        {id:8,title:'Product 8', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price: 90.25},
        {id:9,title:'Product 9', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price: 98.68},
        {id:10,title:'Product 10', desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ex.", price:197.36},
    ],
    addedItems: [],
    total: 0
};

const cartReducer = (state = initState, action) => {

    //INSIDE HOME COMPONENT
    if (action.type === ADD_TO_CART) {
        let addedItem = state.items.find(item => item.id === action.id);
        //check if the action id exists in the addedItems
        let existed_item = state.addedItems.find(item => action.id === item.id);
        if (existed_item) {
            addedItem.quantity += 1;
            return {
                ...state,
                total: state.total + addedItem.price
            }
        } else {
            addedItem.quantity = 1;
            //calculating the total
            let newTotal = state.total + addedItem.price;

            return {
                ...state,
                addedItems: [...state.addedItems, addedItem],
                total: newTotal
            }
        }
    }

    if (action.type === REMOVE_ITEM) {
        let itemToRemove = state.addedItems.find(item => action.id === item.id)
        let new_items = state.addedItems.filter(item => action.id !== item.id)

        //calculating the total
        let newTotal = state.total - (itemToRemove.price * itemToRemove.quantity)
        console.log(itemToRemove)
        return {
            ...state,
            addedItems: new_items,
            total: newTotal
        }
    }

    //INSIDE CART COMPONENT
    if (action.type === ADD_QUANTITY) {
        let addedItem = state.items.find(item => item.id === action.id);
        addedItem.quantity += 1;
        let newTotal = state.total + addedItem.price;
        return {
            ...state,
            total: newTotal
        }
    }

    if (action.type === SUB_QUANTITY) {
        let addedItem = state.items.find(item => item.id === action.id);
        //if the qt == 0 then it should be removed
        if (addedItem.quantity === 1) {
            let new_items = state.addedItems.filter(item => item.id !== action.id);
            let newTotal = state.total - addedItem.price;
            return {
                ...state,
                addedItems: new_items,
                total: newTotal
            }
        } else {
            addedItem.quantity -= 1;
            let newTotal = state.total - addedItem.price;
            return {
                ...state,
                total: newTotal
            }
        }
    }

    if (action.type === ADD_COUPON) {
        return {
            ...state,
            total: state.total + 6
        }
    }

    if (action.type === 'SUB_SHIPPING') {
        return {
            ...state,
            total: state.total - 6
        }
    } else {
        return state
    }
};

export default cartReducer

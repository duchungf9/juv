import {HTTP} from '../../../mixins/http-common';
import notifier from '../../../mixins/notifier';

export default {
    mixins: [notifier],

    data() {
        return {
            baseUrl: window.urlAjaxHandler+"/api/store/",
            hasError: false,
        }
    },
    methods: {
        addProductToCart() {
            return HTTP.post(this.add_to_cart_url(), {
                    product_code: this.product.code,
                    quantity: this.quantity
                })
                .then(this.refreshCart)
                .catch(e => {
                    //self.errors.push(e)
                    this.notifyError(e)
                })
        },
        updateItemQuantity(q, id) {
            return HTTP.post(this.update_url(), {
                    id: id,
                    quantity: q
                 })
                .catch(e => {
                    this.notifyError(e)
                })
        },
        deleteItem(id) {
            return HTTP.post(this.delete_url(), {id})
                .then(this.updateCartItems)
                .catch(e => {
                      this.notifyError(e)
                })
        },
        removeDiscount(){
            return HTTP.delete(this.delete_coupon_url())
                .then(this.updateCoupon)
                .catch(e => {
                    this.notifyError(e)
                })
        },
        refreshCart({data}) {
            cartBus.emit('ADD_ITEM_TO_CART', data.data)
            this.modalOpen = true;
        },
        gotToCart() {
            location.href= window.urlAjaxHandler+'/cart';
        },
        updateCartItems({data}) {
            cartBus.emit('DELETE_ITEM_FROM_CART', data.data)
            this.notify(data.msg)
        },


        add_to_cart_url() {
            return `${this.baseUrl}cart-item-add`;;
        },
        delete_url() {
            return `${this.baseUrl}cart-item-remove`;
        },
        delete_coupon_url() {
            return `${this.baseUrl}coupon-remove`;
        },
        update_url() {
            return `${this.baseUrl}cart-item-update`;
        },

        // calculate the product total amount
        getProductTotalAmount(product){
              return product.price * product.quantity;
        },
        // calculate  discount
        calculateDiscount(product_total=0){

            if(this.cart.discount_type=='amount') return this.cart.discount_amount;
            if(this.cart.discount_type=='percent') return product_total * (this.cart.discount_amount/100);
            return null;
        },
 }
}
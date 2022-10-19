<template>
  <div class="form col-12 col-sm-8 col-xl-7">
    <div class="product-page-add">
      <slot name="label"></slot>
      <div class="product-page-add-input">
        <number-input
            ref="control"
            :min="this.min"
            :max="this.max"
            v-model.number="quantity"
            :qty="value"
            :step="this.step"
        />
      </div>
      <a href="#" class="product-page-add-button btn btn-primary btn-block" @click.prevent.stop="addProductToCart">
        <slot name="btn_label"></slot>
      </a>
    </div>
    <confirm-modal :show="modalOpen" @close="modalOpen = false">
      <template #modal-header>{{$t('store.alerts.add_success')}}</template>
      <template #modal-body>
        <div class="shopping-cart-item-preview d-flex my-3">
          <img :src="product.thumb_image" class="shopping-cart-image-preview">
          <div class="shopping-cart-item-body-preview ms-2">
            <b>{{ product.code}} - {{product.title}}</b>
            <div>Qt:{{product.quantity}}</div>
            <div>{{$t('store.cart.table.price')}} : {{ formatCurrency(getProductTotalAmount(product))}} ({{formatCurrency(product.price)}})</div>
          </div>
        </div>
      </template>
      <template #modal-footer="{closeModal}">
        <button @click="closeModal" type="button" class="btn btn-primary my-2">
          {{$t('store.cart.continue')}}
        </button>
        <button @click.prevent="gotToCart" type="button" class="btn btn-accent">
          {{$t('store.cart.checkout')}}
        </button>
      </template>
    </confirm-modal>
  </div>
</template>
<script>
import cartHelper  from './repository/store';
import confirmModal from '../BaseComponent/ModalComponent'
import numberInput from '../BaseComponent/InputNumberComponent'
import formatCurrencyApi from "./repository/CurrencyFormatterApi"
export default {
  components: {confirmModal,numberInput},
  mixins: [cartHelper],
  setup(){
    const { formatCurrency } = formatCurrencyApi ();
    return {
      formatCurrency
    }
  },
  props: {
    product: Object,
    max: {
      type: Number,
      default: Infinity,
    },
    min: {
      type: Number,
      default: 0,
    },
    step: {
      type: Number,
      default: 1,
    },
    qty: {
      type: Number,
      default: 1,
    },
    value: {
      type: Number,
      default: 1,
    }
  },
  data() {
    return {
      quantity:  {
        type: Number,
        default: 1,
      },
      modalOpen: false,
      modalContent :{},
      item: {},
    }
  },
  created() {
    this.quantity = (this.value)?this.value:this.min;
  },
  methods: {

    update(q) {
      this.quantity =this.round(q,this.step);
      this.$refs.control.quantity = this.quantity;
      this.$refs.control.isActive=false;
    },
    round(value, step) {
      step || (step = 1.0);
      let inv = 1.0 / step;
      return Math.round(value * inv) / inv;
    },
    updateModal(cart_items){
      this.item =cart_items.find(obj => obj.product_code == this.product.code)
      this.product.quantity=this.item.quantity;
      this.product.thumb_image=this.item.product.thumb_image;
    },

  },

  mounted() {
    cartBus.on('ADD_ITEM_TO_CART', ({cart_count,cart_items}) => {
      this.counterItems = (_.isUndefined(cart_count))?1:cart_count;
      this.updateModal(cart_items)
    })
  }
}
</script>
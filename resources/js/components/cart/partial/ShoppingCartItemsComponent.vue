<template>
  <div class="dropdown-item">
    <div class="shopping-cart-item">
      <img :src="item.product.thumb_image" class="rounded">
      <div class="shopping-cart-item-body">
        <b>{{ item.product.code }} - {{ item.product.title }}</b>
        <div>Qt:{{ item.quantity }}</div>
        <div>{{ $t('store.cart.table.price') }}: {{ formatCurrency(item.product.price) }}</div>
        <i class="fas fa-trash shopping-cart-delete"
           @click.prevent.stop="deleteHandler"></i>
      </div>
    </div>
  </div>
</template>
<script>
import cartHelper from "../repository/store";
import formatCurrencyApi from "../repository/CurrencyFormatterApi";

export default {
  mixins: [cartHelper],
  props: ['item', 'index'],
  setup(){
    const  { formatCurrency } = formatCurrencyApi ();
    return { formatCurrency }
  },
  methods: {
    deleteHandler: function () {
      this.$emit('delete-item')
    }
  }
}
</script>

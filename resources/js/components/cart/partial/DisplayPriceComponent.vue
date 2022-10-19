<template>
  <div class="cart__product-box">
    <del class="cart__price-full me-1"
         v-if="product.full_price">{{ formatCurrency(product.full_price) }}
    </del>
    <span class="cart__product-price">{{ formatCurrency(product.price) }}</span>
  </div>
</template>

<script>
import formatCurrencyApi from "../repository/CurrencyFormatterApi";

export default {
  name: "DisplayPriceComponent",
  props: {
    product: {
      type: Object,
      required: true
    },
  },
  setup() {
    const {formatCurrency} = formatCurrencyApi();
    return {formatCurrency}
  },
}
</script>


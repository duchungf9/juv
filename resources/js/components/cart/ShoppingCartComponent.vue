<template>
  <ul class="shopping-cart-box">
    <li class="nav-item dropdown shopping-cart">
      <cart-icon :is-mobile="this.isMobile"
                 :href="this.cart_url" :counter="this.counterItems" :icon="this.icon"></cart-icon>
      <div v-show="!this.isMobile" class="dropdown-menu dropdown-menu-right" aria-labelledby="shoppingDropdownMenuLink">
        <div class="dropdown-item checkout-link">
          <a v-if="this.counterItems" class="btn btn-warning btn-sm btn-block btn-checkout"
             :href="this.cart_url">{{ $t('store.cart.checkout') }}</a>
          <span v-else class="btn btn-light btn-sm btn-block btn-checkout">{{ $t('store.cart.empty') }}</span>
        </div>
        <cart-item
            v-for="(item,index) in this.items" :item="item" :index="index" :key="item.id"
            @delete-item="deleteCartItem(index,item.id)"/>
      </div>
    </li>
  </ul>
</template>
<script>
import cartHelper from './repository/store';
import cartItem from './partial/ShoppingCartItemsComponent';
import cartIcon from './partial/ShoppingCartIconComponent';

export default {
  mixins: [cartHelper],
  components: {cartItem, cartIcon},
  props: ['icon', 'cart_url', 'counter', 'cartItems', 'isMobile'],
  data() {
    return {
      items: {},
      counterItems: 0
    }
  },
  created() {
    this.items = this.cartItems;
    this.counterItems = this.counter;
  },
  mounted() {
    cartBus.on('ADD_ITEM_TO_CART', (payload) => {
      this.updateData(payload);
    });
    cartBus.on('DELETE_ITEM_FROM_CART', ({cart_count}) => {
      this.counterItems = cart_count;
    })
  },
  methods: {
    deleteCartItem(index, id) {
      let items = this.items
      let self = this;

      bootbox.setLocale(window._LANG);
      let msgHtml = "<h4>" + this.$t('store.items.are_you_sure_to_remove') + "</h4>";

      bootbox.confirm({
            title: "Newsletter",
            message: msgHtml
          },
          function (confirmed) {
            if (confirmed) {
              items.splice(index, 1);
              self.deleteItem(id)
            }
          });
    },
    updateData({cart_count, cart_items}) {
      this.counterItems = cart_count;
      this.items = cart_items;
    }
  }
}
</script>

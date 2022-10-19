<template>
    <a  class="nav-link dropdown-toggle"
        id="shoppingDropdownMenuLink"
        :data-bs-toggle="(this.isMobile)?'':'dropdown'"
        aria-haspopup="true" aria-expanded="false">
        <i :class="this.icon"></i>
        <span v-show="this.counter"
              class="shopping-cart-count badge bg-danger">{{this.counter}}</span>
    </a>
</template>
<script>
    export default {
        props: ['icon', 'cart_url', 'counter','isMobile'],
    }
</script>

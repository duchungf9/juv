
import { createApp } from 'vue';

// languageBundle
import languageBundle from '@kirschbaum-development/laravel-translations-loader!@kirschbaum-development/laravel-translations-loader';
import { createI18n } from 'vue-i18n'

const i18n = createI18n({
    locale: window._LANG, // set locale
    fallbackLocale: 'en', // set fallback locale
    messages: languageBundle,
    // If you need to specify other options, you can set other options
    // ...
})

// eventHub emitter
import mitt from 'mitt'
window.cartBus = mitt()


// Components
import CartResume  from './../components/cart/CartResumeComponent';
import CartAddItem  from './../components/cart/AddToCartComponent'
import ShoppingCart  from './../components/cart/ShoppingCartComponent'
import CouponComponent from './../components/cart/CouponComponent'
import ProductCombinations from './../components/cart/ProductCombinationComponet'


// init  app
const app = createApp({
    components: {
        CartResume,
        CartAddItem,
        ShoppingCart,
        CouponComponent,
        ProductCombinations
    }
});



app.use(i18n);
app.mount("#app");



import {ref} from 'vue'
export default function currencyFormatter(currency=null,locale=null) {

    const active_currency = ref(currency??'EUR');
    const active_locale = ref(locale ?? window._LOCALE);

    function formatCurrency(amount){
       return new Intl.NumberFormat( active_locale.value , {
            style: 'currency',
            currency: active_currency.value,
        }).format(amount)
    }
    return {formatCurrency}
};
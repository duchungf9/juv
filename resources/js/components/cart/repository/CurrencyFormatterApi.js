import {ref} from 'vue'
/** simple currency formatter composition api**/
export default function currencyFormatter() {
    const currency = ref(window.StoreConfig.currency);
    const locale = ref(window._LANG);

    // format currency
    function formatCurrency(value){
        let amount = validateNumber(value);
        return new Intl.NumberFormat( 'it' , {
            style: 'currency',
            currency: currency.value,
        }).format(amount)
    }
    // validate number
    function validateNumber(value){
        if(isNaN(value)) return 0;
        return value;
    }
    return {formatCurrency}
};
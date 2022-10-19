import {ref} from 'vue'
import {HTTP} from '../../mixins/http-common';
import {notifyError} from "./use-notifier";

export default  function useFetch(url,params={}) {
    const response = ref(null);
    const data = ref([]);
    const error = ref(null);
    const loading = ref(null)

    const fetch = async() =>{
        loading.value = true;
        try {
            await HTTP.get(url,{params})
                .then(result => {
                    response.value = result;
                    data.value = result.data.data
                 })
                .catch(ex => {
                    error.value = ex.message;
                    notifyError(error.value)

                })
        }
        catch (ex){
            error.value = ex
        }

    }
    fetch().finally(()=> loading.value = false)
    return {response,error,loading,fetch,data}
}
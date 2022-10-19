import useFetch from "../../composable/use-fetch";
import {computed, reactive} from "vue";


export default function useDashBoardApi() {
    const form = reactive({
        section: '',
        searchText: '',
    })
    const {data: items, error, loading} = useFetch(window._SERVER_PATH + `/api/dashboard`)

    const dashBoardItems = computed(() => { // <-------
        if (items.value) {
            return items.value.filter(item => {
                    return (
                        item.title.toLowerCase().includes(form.searchText.toLowerCase())
                        &&
                        item.section.toLowerCase().includes(form.section.toLowerCase())
                    )
                }
            )
        }
    });
    return {
        dashBoardItems, error, loading, items, form
    }
};
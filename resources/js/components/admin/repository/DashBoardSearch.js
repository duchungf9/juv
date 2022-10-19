import useFetch from "../../composable/use-fetch";

export default function useDashBoardSearchApi() {
    const { data:sections,error,loading } =  useFetch(window._SERVER_PATH + `/api/sections`)
    return {
        sections,error,loading
    }
};
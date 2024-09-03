import { defineStore } from "pinia";
import { useApiUrl } from "~/composables/url";
import type { Item } from "~/types/item";
import type { PaginatedResponse } from "~/types/pagination";

export const useItemStore = defineStore('item', () => {
    const data = ref<Item[]>([])
    const onLoading = ref(false)
    const error = ref()

    // filters
    const search = ref('')
    const sortBy = ref(['name'])
    const sortDir = ref(['asc'])
    const perPage = ref(10)
    const page = ref(1)

    async function fetch() {
        const url = useApiUrl(
            '/item', 
            page.value, perPage.value, search.value, 
            sortBy.value.map(s => s.toLowerCase()), 
            sortDir.value.map(s => s.toLowerCase())
        )

        onLoading.value = true
        try {
            const { data: dataReponse } = await useFetch<PaginatedResponse<Item>>(url)
            data.value = dataReponse.value?.data ?? []
        } catch (e) {
            error.value = "Something went wrong"
        } finally {
            onLoading.value = false
        }
    }

    return {
        data,
        onLoading,
        error,
        search,
        sortBy,
        sortDir,
        perPage,
        page,
        fetch,
    }
})
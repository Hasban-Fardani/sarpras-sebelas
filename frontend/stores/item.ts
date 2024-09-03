import { defineStore } from "pinia";
import type { Item } from "~/types/item";
import type { PaginatedResponse } from "~/types/pagination";

export const useItemStore = defineStore('item', () => {
    const items = ref<Item[]>([])
    const onLoading = ref(false)
    const error = ref(null)

    const config = useRuntimeConfig();
    const apiUrl = config.public.apiBase;

    async function fetchItems() {
        onLoading.value = true
        try {
            const { data } = await useFetch<PaginatedResponse<Item>>(`${apiUrl}/item`)
            items.value = data.value?.data ?? []
        } catch (e) {
            error.value = response
        } finally {
            onLoading.value = false
        }
    }

    return {
        items,
        onLoading,
        error,
        fetchItems
    }
})
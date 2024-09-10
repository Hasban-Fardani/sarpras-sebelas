import { defineStore } from "pinia";
import { useApiUrl, useApiResourceUrl } from "~/composables/url";
import type { Item } from "~/types/item";
import type { PaginatedResponse } from "~/types/pagination";

export const useItemStore = defineStore('item', () => {
    const data = ref<Item[]>([])
    const onLoading = ref(false)
    const error = ref()

    // filters
    const search = ref('')
    const sortBy = ref()
    const sortDir = ref()
    const perPage = ref(10)
    const page = ref(1)

    async function fetch() {
        const url = useApiResourceUrl(
            'item', 
            page.value, perPage.value, search.value, 
            sortBy.value, 
            sortDir.value
        )

        onLoading.value = true
        const token = useLocalStorage('sanctum.storage.token', '')
        try {
            const { data: dataReponse, status, refresh } = await useFetch<PaginatedResponse<Item>>(url, {
                headers: {
                    Authorization: `Bearer ${token.value}`
                }
            })
            
            data.value = dataReponse.value?.data ?? []

            console.log("status: ", status.value, "data on fetch: ", data.value)
            return refresh
        } catch (e) {
            error.value = "Something went wrong"
        } finally {
            onLoading.value = false
        }
    }

    async function update(item: Item) {
        const url = `${useApiUrl()}/item/${item.id}`;
        const token = useLocalStorage('sanctum.storage.token', '');
        try {
            await useFetch(url, {
                method: 'PUT',
                headers: {
                    Authorization: `Bearer ${token.value}`,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(item),
            });
            await fetch(); // Refresh data after update
        } catch (e) {
            error.value = "Failed to update item";
        }
    }

    
    async function destroy(id: number) {
        const url = `${useApiUrl()}/item//${id}`
        const token = useLocalStorage('sanctum.storage.token', '');
        try {
            await useFetch(url, {
                method: 'DELETE',
                headers: {
                    Authorization: `Bearer ${token.value}`,
                },
            });
            await fetch();
        } catch (e) {
            error.value = "Failed to delete item";
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
        update,
        destroy
    }
})
import { defineStore } from "pinia";
import { useApiResourceUrl } from "~/composables/url";
import type { ItemRequest } from "~/types/item_request";
import type { PaginatedResponse } from "~/types/pagination";

export const useItemRequestStore = defineStore('itemRequest', () => {
    const data = ref<ItemRequest[]>([])
    const onLoading = ref(false)
    const error = ref()

    // filters
    const search = ref('')
    const sortBy = ref('name')
    const sortDir = ref('asc')
    const perPage = ref(10)
    const page = ref(1)

    const url = computed(() =>
        useApiResourceUrl(
          "request-item",
          page.value,
          perPage.value,
          search.value,
          sortBy.value,
          sortDir.value
        )
      );

    async function fetch() {
        onLoading.value = true;
        const token = useLocalStorage("sanctum.storage.token", "");
        try {
          const { data: dataReponse } = await $fetch<
            PaginatedResponse<ItemRequest>
          >(url.value, {
            headers: {
              Authorization: `Bearer ${token.value}`,
            },
          });
    
          data.value = dataReponse ?? [];
    
          // wait for a second before its clearly done
          setTimeout(() => {
            onLoading.value = false;
          }, 1000);
    
          onLoading.value = false;
        } catch (e) {
          error.value = e;
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
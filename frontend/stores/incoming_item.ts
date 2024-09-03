import { defineStore } from "pinia";
import { useApiUrl } from "~/composables/url";
import type { IncomingItem } from "~/types/incoming_items";
import type { PaginatedResponse } from "~/types/pagination";

export const useIncomingItemStore = defineStore("incomingItem", () => {
  const data = ref<IncomingItem[]>([]);
  const onLoading = ref(false);
  const error = ref();

  // filters
  const search = ref("");
  const sortBy = ref(["name"]);
  const sortDir = ref(["asc"]);
  const perPage = ref(10);
  const page = ref(1);

  async function fetch() {
    const url = useApiUrl(
      "/incoming_item",
      page.value,
      perPage.value,
      search.value,
      sortBy.value.map((s) => s.toLowerCase()),
      sortDir.value.map((s) => s.toLowerCase())
    );

    onLoading.value = true;
    try {
      const { data: dataReponse } = await useFetch<PaginatedResponse<IncomingItem>>(url);
      data.value = dataReponse.value?.data ?? [];
    } catch (e) {
      error.value = e;
    } finally {
      onLoading.value = false;
    }
  }

  return {
    data,
    onLoading,
    error,
    fetch,
  };
});

import { defineStore } from "pinia";
import { useApiResourceUrl } from "~/composables/url";
import type { OutgoingItem } from "~/types/outgoing_items";
import type { PaginatedResponse } from "~/types/pagination";

export const useOutgoingItemStore = defineStore("itemRequest", () => {
  const data = ref<OutgoingItem[]>([]);
  const onLoading = ref(false);
  const error = ref();

  // filters
  const search = ref("");
  const sortBy = ref("name");
  const sortDir = ref("asc");
  const perPage = ref(10);
  const page = ref(1);
  const url = computed(() =>
    useApiResourceUrl(
      "outgoing-item",
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
        PaginatedResponse<OutgoingItem>
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
  };
});

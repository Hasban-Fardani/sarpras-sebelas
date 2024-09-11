import { defineStore } from "pinia";
import { useApiUrl, useApiResourceUrl } from "~/composables/url";
import type { Item } from "~/types/item";
import type { PaginatedResponse } from "~/types/pagination";

export const useItemStore = defineStore("item", () => {
  const data = ref<Item[]>([]);
  const onLoading = ref(false);
  const error = ref();

  // filters
  const search = ref("");
  const sortBy = ref();
  const sortDir = ref();
  const perPage = ref(10);
  const page = ref(1);
  const url = computed(() =>
    useApiResourceUrl(
      "item",
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
      const { data: dataReponse } = await $fetch<PaginatedResponse<Item>>(
        url.value,
        {
          headers: {
            Authorization: `Bearer ${token.value}`,
          },
        }
      );

      data.value = dataReponse ?? [];

      // wait for a second before its clearly done
      setTimeout(() => {
        onLoading.value = false;
      }, 1000);

      onLoading.value = false;
    } catch (e) {
      error.value = "Something went wrong";
    }
  }

  async function update(item: Item) {
    const url = `${useApiUrl()}/item/${item.id}`;
    const token = useLocalStorage("sanctum.storage.token", "");
    try {
      await useFetch(url, {
        method: "PUT",
        headers: {
          Authorization: `Bearer ${token.value}`,
          "Content-Type": "application/json",
        },
        body: JSON.stringify(item),
      });
      await fetch();
    } catch (e) {
      error.value = "Failed to update item";
    }
  }

  async function destroy(id: number) {
    const url = `${useApiUrl()}/item//${id}`;
    const token = useLocalStorage("sanctum.storage.token", "");
    try {
      await useFetch(url, {
        method: "DELETE",
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
    destroy,
  };
});

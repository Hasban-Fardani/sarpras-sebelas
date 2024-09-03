import { defineStore } from "pinia";
import { useApiUrl } from "~/composables/url";
import type { Category } from "~/types/category";
import type { PaginatedResponse } from "~/types/pagination";

export const useCategoryStore = defineStore("category", () => {
  const data = ref<Category[]>([]);
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
      "/category",
      page.value,
      perPage.value,
      search.value,
      sortBy.value.map((s) => s.toLowerCase()),
      sortDir.value.map((s) => s.toLowerCase())
    );

    onLoading.value = true;
    try {
      const { data: dataReponse } = await useFetch<PaginatedResponse<Category>>(url);
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

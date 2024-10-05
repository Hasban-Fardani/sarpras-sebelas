import type { CreateItem } from "@/types/item";
import type { ItemRequest } from "@/types/item_request";
import type { UpdateTableArgs } from "@/types/table";
import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";
import { useUserStore } from "./user";


const BACKEND_URL = import.meta.env.VITE_BACKEND_URL;

export const useItemRequestStore = defineStore("item_request", () => {
  const items = ref<ItemRequest[]>([]);
  const total = ref(0);
  const perPage = ref(5);
  const page = ref(1);
  const searchName = ref("");
  const onUpdate = ref(false);
  const shortBy = ref(null);
  const headers = [
    {
      title: "name",
      key: "employee.name",
    },
    {
      title: "Jumlah",
      key: "total_items",
    },
    {
      title: "Status",
      key: "status",
    },
    {
      title: "Tanggal",
      key: "created_at",
    },
    {
      title: "Action",
      key: "id",
      sortable: false,
    },
  ];

  async function getAll() {
    const user = useUserStore();
    const { data } = await axios.get(`${BACKEND_URL}/request-item?page=${page.value}&per_page=${perPage.value}&search=${searchName.value}`, {
      headers: {
        Authorization: `Bearer ${user.data.token}`,
      },
    });

    console.log(data.data);
    items.value = data.data;
    total.value = data.total;
  }

  function get(id: number) {
    return items.value.find((i) => i.id === id);
  }

  async function updateTable(args: UpdateTableArgs) {
    page.value = args.page;
    perPage.value = args.itemsPerPage;

    if (!onUpdate.value) {
      onUpdate.value = true;
      setTimeout(async () => {
        await getAll();
        onUpdate.value = false;
      }, 1000);
    }
  }

  async function refresh() {
    const args: UpdateTableArgs = {
      page: page.value,
      itemsPerPage: perPage.value,
      shortBy: shortBy.value,
    };

    updateTable(args);
  }

  function addItem(item: CreateItem) {
    const data = new FormData();
    data.append("name", item.name);
    data.append("gambar", item.gambar);
    data.append("category_id", item.category_id.toString());
    data.append("stock", item.stock.toString());
    data.append("price", item.price.toString());
  }

  function updateRequest() {}

  function deleteReqest() {}

  return {
    items,
    total,
    headers,
    perPage,
    page,
    searchName,
    onUpdate,
    get,
    getAll,
    updateTable,
    deleteReqest,
    updateRequest,
    addItem,
  };
});

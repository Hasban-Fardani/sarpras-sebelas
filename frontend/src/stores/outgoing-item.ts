import type { OutgoingItem, OutgoingItemDetail } from "@/types/outgoing_item";
import type { UpdateTableArgs } from "@/types/table";
import axios, { type AxiosRequestConfig } from "axios";
import { defineStore } from "pinia";
import { computed, ref } from "vue";
import { useUserStore } from "./user";

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL;

export const useOutgoingItemStore = defineStore("outgoing-item", () => {
	const items = ref<OutgoingItem[]>([]);
	const item_details = ref<OutgoingItemDetail[]>([]);
	const total = computed(() => items.value?.length);
	const perPage = ref(5);
	const page = ref(1);
	const searchName = ref("");
	const shortBy = ref(null);
	const onUpdate = ref(false);
  const headers = [
    {
      title: 'Operator',
      key: 'operator.name'
    },
    {
      title: 'Divisi',
      key: 'division.name'
    },
    {
      title: 'Deskripsi',
      key: 'note'
    },
    {
      title: 'Tanggal',
      key: 'created_at'
    },
    {
      title: 'Aksi',
      key: 'id',
      sortable: false
    }
  ]

	async function getAll() {
		const config: AxiosRequestConfig = {
			headers: {
				Authorization: `Bearer ${useUserStore().data.token}`,
			},
		};

		try {
			const url = `${BACKEND_URL}/outgoing-item?page=${page.value}&per_page=${perPage.value}&search=${searchName.value}`;
			const { data } = await axios.get(url, config);
	
			items.value = data.data;
		} catch (error) {
      await useUserStore().logout()
		}
	}

	async function getDetails(id: number | string) {
		const config: AxiosRequestConfig = {
			headers: {
				Authorization: `Bearer ${useUserStore().data.token}`,
			},
		};

		const url = `${BACKEND_URL}/incoming-item/${id}/detail`;
		const { data } = await axios.get(url, config);

		item_details.value = data.data;
	}

	function updateTable(args: UpdateTableArgs) {
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

	return {
		items,
    item_details,
    total,
    headers,
    perPage,
    page,
    searchName,
    onUpdate,
		getAll,
		refresh,
    updateTable,
    getDetails,
	};
});

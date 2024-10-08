import type { CreateItemInDetail, ItemIn, ItemInDetail } from '@/types/item_in'
import type { UpdateTableArgs } from '@/types/table'
import axios, { type AxiosRequestConfig } from 'axios'
import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import { useUserStore } from './user'

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL

export const useItemInStore = defineStore('item_in', () => {
  const items = ref<ItemIn[]>([])
  const item_details = ref<ItemInDetail[]>([])
  const total = computed(() => items.value?.length)
  const perPage = ref(5)
  const page = ref(1)
  const searchName = ref('')
  const shortBy = ref(null)
  const onUpdate = ref(false)
  const headers = [
    {
      title: 'Operator',
      key: 'employee.name'
    },
    {
      title: 'Supplier',
      key: 'supplier.name'
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
      title: 'Action',
      key: 'id',
      sortable: false
    }
  ]

  async function getAll() {
    const config: AxiosRequestConfig = {
      headers: {
        Authorization: `Bearer ${useUserStore().data.token}`
      }
    }

    const url = `${BACKEND_URL}/incoming-item?page=${page.value}&per_page=${perPage.value}&search=${searchName.value}`;
    const {data} = await axios.get(url, config)

    items.value = data.data
  }

  async function getDetails(id: number | string) {
    const config: AxiosRequestConfig = {
      headers: {
        Authorization: `Bearer ${useUserStore().data.token}`
      }
    }

    const url = `${BACKEND_URL}/incoming-item/${id}/detail`;
    const {data} = await axios.get(url, config)

    item_details.value = data.data
  }

  function updateTable(args: UpdateTableArgs) {
    page.value = args.page
    perPage.value = args.itemsPerPage
   
    if (!onUpdate.value) {
      onUpdate.value = true
      setTimeout(async () => {
        await getAll()
        onUpdate.value = false
      }, 1000)
    }
  }

  async function refresh() {
    const args: UpdateTableArgs = {
      page: page.value,
      itemsPerPage: perPage.value,
      shortBy: shortBy.value
    }
    
    updateTable(args)
  }

  async function addItem(supplier_id: number | string, note: string, items: CreateItemInDetail[]) {
    onUpdate.value = true
    const data = new FormData()
    
    data.append('supplier_id', supplier_id.toString())
    data.append('note', note)

    // add items to data
    for (const item of items) {
      data.append('items[]', JSON.stringify(item))
    }
    
    const config: AxiosRequestConfig = {
      headers: {
        'Content-Type': 'multipart/form-data',
        Authorization: `Bearer ${useUserStore().data.token}`
      }
    }

    await axios.post(`${BACKEND_URL}/incoming-item`, data, config)

    onUpdate.value = false
    refresh()
  }

  function updateItem() {}

  function deleteItem() {}

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
    getDetails,
    updateTable,
    deleteItem,
    updateItem,
    addItem,
  }
})

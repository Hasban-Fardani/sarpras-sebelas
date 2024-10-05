import type { ItemOut, ItemOutDetail } from '@/types/item_out'
import type { UpdateTableArgs } from '@/types/table'
import axios from 'axios'
import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import { useUserStore } from './user'


const BACKEND_URL = import.meta.env.VITE_BACKEND_URL

export const useItemOutStore = defineStore('item_out', () => {
  const items = ref<ItemOut[]>([])
  const item_details = ref<ItemOutDetail[]>([])
  const total = ref(0)
  const perPage = ref(5)
  const page = ref(1)
  const searchName = ref('')
  const shortBy = ref(null)
  const onUpdate = ref(false)
  const headers = [
    {
      title: 'Unit Kerja',
      key: 'division.name'
    },
    {
      title: 'Operator',
      key: 'operator.name'
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
    const user = useUserStore()
    const { data } = await axios.get(`${BACKEND_URL}/item-out?page=${page.value}&per_page=${perPage.value}&search=${searchName.value}`, {
      headers: {
        Authorization: `Bearer ${user.data.token}`
      }
    })
    console.log(data.data)

    items.value = data.data
    total.value = data.total
  }

  function get(id: number) {
    return items.value.find((i) => i.id === id)
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

  function addItem() {
    // const data = new FormData()
  }

  function updateItem() {}

  function deleteItem() {}

  return {
    items,
    total,
    headers,
    perPage,
    page,
    searchName,
    onUpdate,
    refresh,
    get,
    getAll,
    updateTable,
    deleteItem,
    updateItem,
    addItem
  }
})

import type { ItemOut } from '@/types/item_out'
import axios from 'axios'
import { defineStore } from 'pinia'
import { ref } from 'vue'
import { useUserStore } from './user'

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL

export const useItemOutStore = defineStore('outgoing-item', () => {
  const itemsOut = ref<ItemOut[]>([])
  const total = ref(0)
  const perPage = ref(5)
  const page = ref(1)

  async function getAll() {
    const user = useUserStore()
    const { data } = await axios.get(`${BACKEND_URL}/outgoing-item?page=${page.value}&per_page=${perPage.value}`, {
      headers: {
        Authorization: `Bearer ${user.data.token}`
      }
    })

    itemsOut.value = data.data
    total.value = data.total
  }

  async function refresh() {
    await getAll()
  }

  return {
    itemsOut,
    total,
    perPage,
    page,
    getAll,
    refresh
  }
})

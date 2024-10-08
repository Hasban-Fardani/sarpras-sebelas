import type { Supplier } from '@/types/supplier'
import type { UpdateTableArgs } from '@/types/table'
import axios, { type AxiosRequestConfig } from 'axios'
import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import { useUserStore } from './user'

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL

export const useSupplierStore = defineStore('supplierStore', () => {
  const suppliers = ref<Supplier[]>([])
  const total = computed(() => suppliers.value?.length)
  const perPage = ref(5)
  const page = ref(1)
  const searchName = ref('')
  const onUpdate = ref(false)
  const shortBy = ref(null)

  const headers = [
    {
      title: 'name',
      key: 'name'
    },
    {
      title: 'phone',
      key: 'phone'
    },
    {
      title: 'address',
      key: 'address'
    },
    {
      title: 'Action',
      key: 'id',
      sortable: false
    }
  ]

  async function getAll() {
    const {data} = await axios.get(`${BACKEND_URL}/admin/upplier?page=${page.value}&per_page=${perPage.value}&search=${searchName.value}`, {
      headers: {
        Authorization: `Bearer ${useUserStore().data.token}`
      }
    })

    suppliers.value = data.data
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

  async function addSupplier(supplier: Supplier) {
    onUpdate.value = true
    const config: AxiosRequestConfig = {
      headers: {
        Authorization: `Bearer ${useUserStore().data.token}`
      }
    }

    await axios.post(`${BACKEND_URL}/supplier`, supplier, config)

    onUpdate.value = false
    refresh()
  }

  function updateSupplier(supplier: Supplier) {

  }

  function deleteSupplier(id: number) {
    
  }

  return {
    suppliers,
    total,
    headers,
    perPage,
    page,
    searchName,
    onUpdate,
    getAll,
    updateTable,
    deleteSupplier,
    updateSupplier,
    addSupplier
  }
})

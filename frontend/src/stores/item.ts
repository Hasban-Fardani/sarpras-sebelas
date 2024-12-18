import type { CreateItem, Item } from '@/types/item'
import type { UpdateTableArgs } from '@/types/table'
import axios, { type AxiosRequestConfig } from 'axios'
import { defineStore } from 'pinia'
import { ref } from 'vue'
import { useUserStore } from './user'

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL
export const useItemStore = defineStore('item', () => {
  const items = ref<Item[]>([])
  const total = ref(0)
  const perPage = ref(5)
  const page = ref(1)
  const shortBy = ref(null)
  const searchName = ref('')
  const onUpdate = ref(false)
  const headers = [
    {
      title: 'Gambar',
      key: 'image',
      sortable: false
    },
    {
      title: 'Nama',
      key: 'name'
    },
    {
      title: 'Kategori',
      key: 'category.name'
    },
    {
      title: 'Harga',
      key: 'price'
    },
    {
      title: 'stok/min.stok',
      key: 'stock'
    },
    {
      title: 'Dibuat',
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

    try {
      const {data} = await axios.get(`${BACKEND_URL}/item?page=${page.value}&per_page=${perPage.value}&search=${searchName.value}`, {
        headers: {
          Authorization: `Bearer ${user.data.token}`
        }
      })
  
      console.log(data.data)
      items.value = data.data
      total.value = data.total
    } catch (error) {
      await useUserStore().logout()
    }
  }

  async function updateTable(args: UpdateTableArgs) {
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

  async function addItem(item: CreateItem) {
    if (!item.image) {
      throw new Error('Input tidak boleh kosong!');
    }
    
    try {
      const data = new FormData()
      data.append('name', item.name)
      data.append('image', item.image)
      data.append('category_id', item.category_id.toString())
      data.append('stock', item.stock.toString())
      data.append('min_stock', item.min_stock.toString())
      data.append('price', item.price.toString())
      data.append('unit', item.unit)
      data.append('merk', item.merk)
      data.append('type', item.type)
      data.append('size', item.size)
  
      const config: AxiosRequestConfig = {
        headers: {
          Authorization: `Bearer ${useUserStore().data.token}`
        }
      }
  
      const res = await axios.post(`${BACKEND_URL}/item`, data, config)
      return res.data
    } catch (error) {
      return error
    }
  }

  async function updateItem(itemToUpdate: Item) {
    if (!itemToUpdate) {
      console.log('no item')
      return
    }

    onUpdate.value = true

    const data = new FormData()
    data.append('_method', "PUT")

    // Check if properties exist before appending
    if (itemToUpdate.name) data.append('name', itemToUpdate.name)
    if (itemToUpdate.image && itemToUpdate.image instanceof Blob) data.append('image', itemToUpdate.image)
    if (itemToUpdate.category_id) data.append('category_id', itemToUpdate.category_id.toString())
    if (itemToUpdate.merk) data.append('merk', itemToUpdate.merk)
    if (itemToUpdate.price) data.append('price', itemToUpdate.price.toString())
    if (itemToUpdate.stock) data.append('stock', itemToUpdate.stock.toString())
    if (itemToUpdate.min_stock) data.append('min_stock', itemToUpdate.min_stock.toString())
    if (itemToUpdate.unit) data.append('unit', itemToUpdate.unit)

    console.log("value ketika passing: ",data, itemToUpdate)

    const config: AxiosRequestConfig = {
      headers: {
        'Content-Type': 'multipart/form-data',
        Authorization: `Bearer ${useUserStore().data.token}`
      }
    }

    const res = await axios.post(`${BACKEND_URL}/item/${itemToUpdate.id}`, data, config)
    console.log(res.data.message)
    onUpdate.value = false

    refresh()
  }

  async function deleteItem(itemId: number) {
    onUpdate.value = true

    const config: AxiosRequestConfig = {
      headers: {
        Authorization: `Bearer ${useUserStore().data.token}`
      }
    }

    await axios.delete(`${BACKEND_URL}/item/${itemId}`, config)

    onUpdate.value = false
    refresh()
  }

  return {
    items,
    total,
    headers,
    perPage,
    page,
    searchName,
    onUpdate,
    getAll,
    refresh,
    updateTable,
    deleteItem,
    updateItem,
    addItem
  }
})

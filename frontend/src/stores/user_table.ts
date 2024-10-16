import type { UpdateTableArgs } from '@/types/table'
import type { User } from '@/types/user'
import axios from 'axios'
import { defineStore } from 'pinia'
import { ref } from 'vue'
import { useUserStore } from './user'


const BACKEND_URL = import.meta.env.VITE_BACKEND_URL

export const useUserTableStore = defineStore('user-table', () => {
  const users = ref<User[]>([])
  const total = ref(0)
  const perPage = ref(5)
  const page = ref(1)
  const searchName = ref('')
  const shortBy = ref(null)
  const onUpdate = ref(false)

  const headers = [
    {
      title: 'username',
      key: 'username'
    },
    {
      title: 'Role',
      key: 'role'
    },
    {
      title: 'NIP',
      key: 'nip'
    },
    {
      title: 'Action',
      key: 'id',
      sortable: false
    }
  ]

  async function getAll() {
    
    try {
      const user = useUserStore()
      const { data } = await axios.get(`${BACKEND_URL}/admin/users?page=${page.value}&per_page=${perPage.value}&search=${searchName.value}`, {
        headers: {
          Authorization: `Bearer ${user.data.token}`
        }
      })
      console.log(data.data)
  
      users.value = data.data
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

  function addUser() {
    // const data = new FormData()
    // data.append('name', item.name)
  }

  function updateCategory() {}

  function deleteCategory() {}

  return {
    users,
    onUpdate,
    total,
    headers,
    perPage,
    page,
    searchName,
    getAll,
    refresh,
    updateTable,
    deleteCategory,
    updateCategory,
    addUser
  }
})

import type { Credentials } from '@/types/credential'
import type { User } from '@/types/user'
import { Preferences } from '@capacitor/preferences'
import axios from 'axios'
import { defineStore } from 'pinia'
import { ref } from 'vue'

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL
export const useUserStore = defineStore('user', () => {
  const data = ref<User>({
    name: '',
    role: undefined,
    token: '',
    unit: ''
  })

  async function load() {
    const ret = await Preferences.get({ key: 'user' })

    if (ret.value == null) {
      return
    }
    
    data.value = JSON.parse(ret.value)
  }

  async function login(credential: Credentials) {
    try {
      const { data: dataResponse } = await axios.post(`${BACKEND_URL}/auth/login`, credential)
      const token = dataResponse.token
      const {name, role} = dataResponse.user
      const unit = role
      data.value = {
        token,
        name: name,
        role,
        unit
      }
      await Preferences.set({
        key: 'user',
        value: JSON.stringify(data.value)
      })
  
      return 'login success'
    } catch (error) {
      return 'login failed'
    }
  }

  async function checkLogin() {
    if (!data.value.token){
      await load()
    }

    if (!data.value.token) return false;
    return true      
  }

  async function clear() {
    data.value = {
      name: '',
      role: undefined,
      token: '',
      unit: ''
    }

    await Preferences.remove({
      key: 'user'
    })
  }

  async function logout() {
    if (!data.value || !data.value.token) {
      await load()
    }

    try {
      const {data: responseData} = await axios.post(`${BACKEND_URL}/auth/logout`, null, {
        headers: {
          Authorization: `Bearer ${data.value.token}`
        }
      })
      console.log(responseData)
    } finally {
      clear()
    }
  }

  return { 
    data, 
    load, 
    login, 
    logout, 
    clear, 
    checkLogin 
  }
})

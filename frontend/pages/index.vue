<script setup lang="ts">
import type { UserLogin } from '~/types/user';

const { user, refreshIdentity } = useSanctumAuth<UserLogin>()

onMounted(async () => {
  if (!user.value && process.client) {
    await refreshIdentity()
  }

  if (user.value) {
    return navigateTo('/redirect')
  }
})
</script>
<template>
  <div class="flex gap-2 justify-center items-center w-screen h-screen">
    <NuxtLink to="/admin/login" class="px-4 py-2 bg-slate-500 border text-white rounded">
      Login Admin
    </NuxtLink> 
  
    <NuxtLink to="/division/login" class="px-4 py-2 bg-slate-500 border text-white rounded">
      Login Unit Kerja
    </NuxtLink> 
  
    <NuxtLink to="/supervisor/login" class="px-4 py-2 bg-slate-500 border text-white rounded">
      Login Kepala Sekolah
    </NuxtLink> 
  </div>
</template>
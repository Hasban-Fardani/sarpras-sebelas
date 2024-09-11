<script setup lang="ts">
import type { UserLogin } from '~/types/user';

const { user, refreshIdentity } = useSanctumAuth<UserLogin>()

onMounted(async () => {
  if (!user.value && process.server) {
    await refreshIdentity()
  }

  if (user.value?.role === 'admin') {
    navigateTo('/admin')
  }

  if (user.value?.role === 'unit') {
    navigateTo('/division')
  }

  if (user.value?.role === 'pengawas') {
    navigateTo('/supervisor')
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
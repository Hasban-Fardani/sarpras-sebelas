<script setup lang="ts">
const { logout } = useSanctumAuth()

const doLogout = async () => {
  logout().catch(async () => {
    await showToast({title: 'Anda sudah logout', description: 'tidak bisa logout, anda tidak terauthentikasi'})
    
    useLocalStorage('sanctum.storage.token', null)
    
    location.reload()
    
    navigateTo('/admin/login')
  })
}
</script>
<template>
  <SDropdownMenu>
    <SDropdownMenuTrigger as-child>
      <SButton variant="secondary" size="icon" class="rounded-full">
        <CircleUserIcon class="h-5 w-5" />
      </SButton>
    </SDropdownMenuTrigger>
    <SDropdownMenuContent align="end">
      <SDropdownMenuLabel>My Account</SDropdownMenuLabel>
      <SDropdownMenuSeparator />
      <SDropdownMenuItem>Settings</SDropdownMenuItem>
      <SDropdownMenuSeparator />
      <SDropdownMenuItem class="cursor-pointer" @click="doLogout">Logout</SDropdownMenuItem>
    </SDropdownMenuContent>
  </SDropdownMenu>
</template>
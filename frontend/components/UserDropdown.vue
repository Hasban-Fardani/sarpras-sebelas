<script setup lang="ts">
const { logout } = useSanctumAuth()

const doLogout = async () => {
  await logout()
  useLocalStorage('sanctum.storage.token', null)
  return  navigateTo('/admin/login')
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
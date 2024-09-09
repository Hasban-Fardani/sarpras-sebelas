<script setup lang="ts">
const sidebarClass = "flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary"
const sidebarActiveClass = "flex items-center gap-3 rounded-lg bg-muted px-3 py-2 text-primary transition-all hover:text-primary"
</script>
<template>
  <NuxtLink to="/admin" :class="sidebarClass" :active-class="sidebarActiveClass">
    <HomeIcon class="h-4 w-4" />
    Dashboard
  </NuxtLink>
  <NuxtLink to="/admin/item" :class="sidebarClass" :active-class="sidebarActiveClass">
    <PackageIcon class="h-4 w-4" />
    Barang
  </NuxtLink>
  <NuxtLink to="/admin/users" :class="sidebarClass" :active-class="sidebarActiveClass">
    <UsersIcon class="h-4 w-4" />
    Akun & Pegawai
  </NuxtLink>
  <NuxtLink to="/admin/report" :class="sidebarClass" :active-class="sidebarActiveClass">
    <LineChartIcon class="h-4 w-4" />
    Analytics
  </NuxtLink>
</template>
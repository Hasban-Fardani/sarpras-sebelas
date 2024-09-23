<script setup lang="ts">
const sidebarClass = "flex items-center gap-3 rounded-lg px-3 py-2 text-black transition-all hover:text-primary"
const sidebarActiveClass = "flex items-center gap-3 rounded-lg px-3 py-2 bg-primary !text-white transition-all"
</script>
<template>
  <NuxtLink to="/admin" :class="sidebarClass" :active-class="sidebarActiveClass">
    <HomeIcon class="h-4 w-4" />
    Dashboard
  </NuxtLink>
  
  <NuxtLink to="/admin/item" :class="sidebarClass" :active-class="sidebarActiveClass">
    <PackageIcon class="h-4 w-4" />
    Barang Gudang
  </NuxtLink>

  <NuxtLink to="/admin/incoming-item" :class="sidebarClass" :active-class="sidebarActiveClass">
    <PackageIcon class="h-4 w-4" />
    Barang Masuk
  </NuxtLink>

  <NuxtLink to="/admin/outgoing-item" :class="sidebarClass" :active-class="sidebarActiveClass">
    <PackageIcon class="h-4 w-4" />
    Barang Keluar
  </NuxtLink>
  
  <NuxtLink to="/admin/submission-item" :class="sidebarClass" :active-class="sidebarActiveClass">
    <PackageIcon class="h-4 w-4" />
    Pengadaan
  </NuxtLink>

  <NuxtLink to="/admin/request-item" :class="sidebarClass" :active-class="sidebarActiveClass">
    <PackageIcon class="h-4 w-4" />
    Permintaan
  </NuxtLink>

  <NuxtLink to="/admin/users" :class="sidebarClass" :active-class="sidebarActiveClass">
    <UsersIcon class="h-4 w-4" />
    Akun & Pegawai
  </NuxtLink>

  <NuxtLink to="/admin/report" :class="sidebarClass" :active-class="sidebarActiveClass">
    <LineChartIcon class="h-4 w-4" />
    Laporan
  </NuxtLink>
</template>
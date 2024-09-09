<script setup lang="ts">
definePageMeta({
  layout: 'auth',
})
</script>
<template>
  <div class="mx-auto grid w-[350px] gap-6">
    <div class="grid gap-2 text-center">
      <h1 class="text-3xl font-bold">
        Login Unit Kerja
      </h1>
      <p class="text-balance text-muted-foreground">
        Masukkan nip anda dan password untuk login sebagai unit kerja
      </p>
    </div>
    <div class="grid gap-4">
      <FormLogin />
    </div>
  </div>
</template>
<script setup lang="ts">
definePageMeta({
  layout: 'auth',
})
</script>
<template>
  <div class="mx-auto grid w-[350px] gap-6">
    <div class="grid gap-2 text-center">
      <h1 class="text-3xl font-bold">
        Login Pengawas
      </h1>
      <p class="text-balance text-muted-foreground">
        Masukkan nip anda dan password untuk login sebagai kepala sekolah / wakasek sarpras
      </p>
    </div>
    <div class="grid gap-4">
      <div class="grid gap-2">
        <SLabel for="nip">Nip</SLabel>
        <SInput id="nip" type="text" placeholder="Nip" required />
      </div>
      <div class="grid gap-2">
        <div class="flex items-center">
          <SLabel for="password">Password</SLabel>
          <NuxtLink to="/forgot-password" class="ml-auto inline-block text-sm underline">
            Lupa password?
          </NuxtLink>
        </div>
        <SInput id="password" type="password" required />
      </div>
      <SButton type="submit" class="w-full">
        Login
      </SButton>
    </div>
  </div>
</template>
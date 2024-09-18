<script setup>
definePageMeta({
  layout: 'admin',
})

const userStore = useUserStore()
const data = computed(() => userStore.data)
const onLoading = computed(() => userStore.onLoading)

onMounted(async () => {
  if (!data.value.length && !onLoading.value) {
    await userStore.fetch()
  }
})
</script>
<template>
  <SCard>
    <SCardContent>
      <TableUserComponent :onLoading="onLoading" :data="data"/>
    </SCardContent>
  </SCard>
</template>
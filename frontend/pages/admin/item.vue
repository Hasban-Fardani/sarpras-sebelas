<script setup lang="ts">
definePageMeta({
  layout: 'admin',
})

const itemStore = useItemStore()
const data = computed(() => itemStore.data)
const onLoading = computed(() => itemStore.onLoading)

onMounted(async () => {
  if (!data.value.length && !onLoading.value) {
    await itemStore.fetch()
  }
})

</script>
<template>
  <TableItemComponent :onLoading="onLoading" :data="data" />
</template>
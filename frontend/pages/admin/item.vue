<script setup lang="ts">
definePageMeta({
  layout: 'admin',
})

const itemStore = useItemStore()
const data = itemStore.data

onBeforeMount(async () => {
  await itemStore.fetch()
  console.log("DATA: ", data);
})

</script>
<template>
  <TableItemComponent :data="data" />
</template>
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
  <div class="w-full flex justify-between">
    <h2 class="text-3xl font-bold">Barang</h2>
    <div>
      <SButton>
        <PlusIcon />
        Tambah
      </SButton>
    </div>
  </div>
  <TableItemComponent :onLoading="onLoading" :data="data" />
</template>
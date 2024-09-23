<script setup lang="ts">
definePageMeta({
  layout: 'admin',
})

const incomingItemStore = useIncomingItemStore()
const data = computed(() => incomingItemStore.data)
const onLoading = computed(() => incomingItemStore.onLoading)

onMounted(async () => {
  if (!data.value.length && !onLoading.value) {
    await incomingItemStore.fetch()
  }
})
</script>
<template>
  <div class="w-full flex justify-between">
    <h2 class="text-3xl font-bold">Barang Masuk</h2>
    <div class="flex">
      <SDialog>
        <SDialogTrigger as-child>
          <SButton>
            <PlusIcon />
            Tambah
          </SButton>
        </SDialogTrigger>
        <SDialogContent class="sm:max-w-[425px]">
          <SDialogHeader>
            <SDialogTitle>Tambah Barang</SDialogTitle>
            <SDialogDescription>
              Pastikan data sudah benar sebelum di submit
            </SDialogDescription>
          </SDialogHeader>
          
          <FormCreateItem />
        </SDialogContent>
      </SDialog>
    </div>
  </div>
  <SCard class="bg-white mt-4">
    <SCardContent>
      <TableIncomingItemComponent :onLoading="onLoading" :data="data" />
    </SCardContent>
  </SCard>
</template>
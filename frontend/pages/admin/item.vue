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
    <div class="flex">
      <SDialog>
        <SDialogTrigger as-child>
          <SButton>
            <PlusIcon />
            Tambah
          </SButton>
        </SDialogTrigger>
        <LazySDialogContent class="sm:max-w-[425px]">
          <SDialogHeader>
            <SDialogTitle>Tambah Barang</SDialogTitle>
            <SDialogDescription>
              Pastikan data sudah benar sebelum di submit
            </SDialogDescription>
          </SDialogHeader>
          
          <LazyFormCreateItem />
        </LazySDialogContent>
      </SDialog>
    </div>
  </div>
  <SCard class="overflow-x-hidden">
    <SCardContent>
      <TableItemComponent :onLoading="onLoading" :data="data" />
    </SCardContent>
  </SCard>
</template>
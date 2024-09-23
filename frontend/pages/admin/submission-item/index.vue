<script setup lang="ts">
definePageMeta({
  layout: 'admin',
})

const itemStore = useItemSubmissionStore()
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
    <h2 class="text-3xl font-bold">Pengajuan Pengadaan Barang</h2>
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
      <TableSubmissionItemComponent :onLoading="onLoading" :data="data" />
    </SCardContent>
  </SCard>  
</template>
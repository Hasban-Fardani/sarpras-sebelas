<script setup lang="ts">
type Props = {
  id: string,
  name: string
}

const props = defineProps<Props>()

const confirm = () => {
  showToast({ title: 'Menghapus', description: `data ${props.name} di hapus`})
}
</script>
<template>
  <SAlertDialog>
    <SAlertDialogTrigger as-child>
      <SButton variant="destructive">
        <TrashIcon/>
      </SButton>
    </SAlertDialogTrigger>
    <SAlertDialogContent>
      <SAlertDialogHeader>
        <SAlertDialogTitle>Apakah Anda yakin akan menghapus {{ props.name }}?</SAlertDialogTitle>
        <SAlertDialogDescription>
          aksi ini tidak bisa dikembalikan kembali, data di server akan benar benar dihapus
          jika anda melanjutkan aksi ini.
        </SAlertDialogDescription>
      </SAlertDialogHeader>
      <SAlertDialogFooter>
        <SAlertDialogCancel>Batal</SAlertDialogCancel>
        <SAlertDialogAction @click="confirm" variant="destructive">
          Hapus
        </SAlertDialogAction>
      </SAlertDialogFooter>
    </SAlertDialogContent>
  </SAlertDialog>
</template>
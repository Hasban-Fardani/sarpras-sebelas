<script setup lang="ts">
import OutgoingItemAddDialog from '@/components/outgoingItem/OutgoingItemAddDialog.vue';
import OutgoingItemTable from '@/components/outgoingItem/OutgoingItemTable.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

</script>
<template>
    <AdminLayout>
        <div class="d-flex ga-2 mb-2">
            <h2>Barang Keluar</h2>
            <VChip color="primary" append-icon="mdi-plus" variant="flat" @click="null">
                Tambah
                <OutgoingItemAddDialog/> 
            </VChip>
        </div>
        <OutgoingItemTable />
    </AdminLayout>
</template>
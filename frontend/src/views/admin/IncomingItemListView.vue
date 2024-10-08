<script setup lang="ts">
import IncomingItemAddDialog from '@/components/incomingItem/IncomingItemAddDialog.vue'
import IncomingItemTable from '@/components/incomingItem/IncomingItemTable.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

</script>
<template>
    <AdminLayout>
        <div class="d-flex ga-2 mb-2">
            <h2>Barang Masuk</h2>
            <VChip 
                color="primary" 
                append-icon="mdi-plus" 
                variant="flat" 
                @click="null"
            >
                Tambah
                <IncomingItemAddDialog/>
            </VChip>
        </div>
        <IncomingItemTable />
    </AdminLayout>
</template>
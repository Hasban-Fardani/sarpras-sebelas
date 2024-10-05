<script setup lang="ts">
import SupplierAddDialog from '@/components/supplier/SupplierAddDialog.vue';
import SupplierTable from '@/components/supplier/SupplierTable.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
</script>
<template>
    <AdminLayout>
        <div class="d-flex ga-2">
            <h2>Supplier</h2>
            <VChip color="primary" variant="flat" append-icon="mdi-plus" @click="null">
                Tambah
                <SupplierAddDialog />
            </VChip>
        </div>
        <SupplierTable />
    </AdminLayout>
</template>
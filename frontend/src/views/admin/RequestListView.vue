<script setup lang="ts">
import ItemRequestTable from '@/components/requestItem/ItemRequestTable.vue';
import RequestForm from '@/components/requestItem/RequestForm.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
</script>
<template>
    <AdminLayout>
        <div class="d-flex ga-2">
            <h2>Permintaan</h2>
            <VChip color="primary" append-icon="mdi-plus" variant="flat" @click="null">
                Buat
                <RequestForm />
            </VChip>
        </div>
        <ItemRequestTable />
    </AdminLayout>
</template>
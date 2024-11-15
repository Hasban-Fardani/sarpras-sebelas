<script lang="ts" setup>
import ItemAddDialog from '@/components/item/ItemAddDialog.vue'
import ItemImportDialog from '@/components/item/ItemImportDialog.vue'
import ItemTable from '@/components/item/ItemTable.vue'
import AdminLayout from '@/layouts/AdminLayout.vue';
import { useItemStore } from '@/stores/item';

</script>
<template>
    <AdminLayout>
        <div class="d-flex align-center ga-2 mb-2">
            <h2>Daftar Barang</h2>
            <v-menu>
                <template v-slot:activator="{ props }">
                    <v-chip color="primary" append-icon="mdi-plus" variant="flat" v-bind="props">
                        Tambah
                    </v-chip>
                </template>
                <v-list>
                    <v-list-item append-icon="mdi-pencil-plus-outline" @click="null">
                        <ItemAddDialog />
                        input
                    </v-list-item>
                    <v-list-item append-icon="mdi-import" @click="null">
                        <ItemImportDialog />
                        import
                    </v-list-item>
                </v-list>
            </v-menu>
        </div>
        <ItemTable />
    </AdminLayout>
</template>

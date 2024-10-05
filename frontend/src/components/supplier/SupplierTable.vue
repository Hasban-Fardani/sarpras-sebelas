<script setup lang="ts">
import type { Supplier } from "@/types/supplier";

import DeleteDialog from "@/components/dialogs/DeleteDialog.vue";
import SupplierEditDialog from "@/components/supplier/SupplierEditDialog.vue";

import { useSupplierStore } from "@/stores/supplier";
import { ref } from "vue";

const supplier = useSupplierStore();

const editDialogShow = ref(false);
const selectedEditCategory = ref<Supplier>({} as Supplier);
const editSupplier = (supplier: Supplier) => {
	selectedEditCategory.value = supplier;
	editDialogShow.value = true;
};

const deleteDialogShow = ref(false);
const selectedDeleteName = ref("");
const selectedDeleteId = ref(0);
const showDeleteDialog = async (id: number, name: string) => {
	deleteDialogShow.value = true;
	selectedDeleteName.value = name;
  selectedDeleteId.value = id;
};

</script>
<template>
    <supplier-edit-dialog 
        :is-active="editDialogShow" 
        :supplier-prop="selectedEditCategory" 
        @close-dialog="editDialogShow = false"
    />

    <delete-dialog 
        type="supplier" 
        :id="selectedDeleteId" 
        :name="selectedDeleteName" 
        :is-active="deleteDialogShow"
        @close-dialog="deleteDialogShow = false" 
        @delete="supplier.deleteSupplier" 
    />

    <div class="w-50 w-md-25">
        <v-text-field 
            v-model="supplier.searchName" 
            class="ma-2" 
            label="cari" 
            variant="outlined" 
            density="comfortable"
            placeholder="Cari deskripsi..." 
            append-inner-icon="mdi-magnify" 
            hide-details 
        />
    </div>
    <v-data-table-server 
        v-model:items-per-page="supplier.perPage" 
        :headers="supplier.headers"
        :items="supplier.suppliers" 
        :items-length="supplier.total" 
        :loading="supplier.onUpdate" 
        :search="supplier.searchName"
        item-value="name" 
        @update:options="supplier.updateTable"
    >
        <template v-slot:item.id="{ item }">
            <div class="d-flex ga-2">
                <v-btn 
                  icon="mdi-square-edit-outline" 
                  color="yellow" 
                  @click="editSupplier(item)" 
                />
                <v-btn 
                  icon="mdi-delete" 
                  color="red" 
                  @click="showDeleteDialog(item.id, item.name)" 
                />
            </div>
        </template>
    </v-data-table-server>
</template>
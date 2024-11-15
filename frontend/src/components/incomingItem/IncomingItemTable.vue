<script setup lang="ts">
import DeleteDialog from "@/components/dialogs/DeleteDialog.vue";
import { useIncomingItemStore } from "@/stores/incoming_item";
import { formatDate } from "@/utils/format_date";
import { onMounted, ref } from "vue";
import DateRangePicker from "../DateRangePicker.vue";

const incomingItem = useIncomingItemStore();

const confirmDeleteDialog = ref(false);
const selectedDeleteName = ref("");
const selectedDeleteId = ref(0);
const suppliers = ref<string[]>([]);
const confirmDelete = (id: number, name: string) => {
	confirmDeleteDialog.value = true;
	selectedDeleteName.value = name;
	selectedDeleteId.value = id;
};

const deleteIncomingItem = () => {};

onMounted(() => {
	suppliers.value = ["supplier 1", "supplier 2"];
});
</script>
<template>
  <delete-dialog 
      type="category" 
      :id="selectedDeleteId" 
      :name="selectedDeleteName" 
      :is-active="confirmDeleteDialog"
      @close-dialog="confirmDeleteDialog = false" 
      @delete="deleteIncomingItem" 
  />
  
  <div class="d-flex flex-wrap w-100 justify-space-between align-center">
    <div class="w-50 w-md-25">
        <v-text-field 
            v-model="incomingItem.searchName" 
            class="ma-2" 
            label="cari" 
            variant="outlined" 
            density="comfortable"
            placeholder="Cari deskripsi..." 
            append-inner-icon="mdi-magnify" 
            hide-details 
        />
    </div>
    <div class="d-flex ga-2 ml-2 mt-3">
        <v-btn variant="outlined" height="48px">
            dd/mm/yy
            <date-range-picker/>
        </v-btn>
        <v-select 
            :items="suppliers" 
            label="supplier" 
            variant="outlined" 
            density="comfortable" 
            width="150" 
            multiple chips clearable
        />
    </div>
  </div>
  <v-data-table-server 
    v-model:items-per-page="incomingItem.perPage" 
    :headers="incomingItem.headers" 
    :items="incomingItem.items"
    :items-length="incomingItem.total" 
    :loading="incomingItem.onUpdate" 
    :search="incomingItem.searchName" 
    item-value="name"
    @update:options="incomingItem.updateTable"
  >
    <template v-slot:item.created_at="{ item }">
      <p>{{ formatDate(item.created_at.toString()) }}</p>
    </template>

    <template v-slot:item.id="{ item }">
      <div class="d-flex ga-2">
        <v-btn 
            icon="mdi-eye" 
            color="primary" 
            :to="`/admin/barang-masuk/${item.id}`" 
        />
        <v-btn 
            icon="mdi-delete" 
            color="red" 
            @click="confirmDelete(item.id, item.created_at.toString())" 
        />
      </div>
    </template>
  </v-data-table-server>
</template>
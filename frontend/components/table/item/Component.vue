<script setup>
import { ref, onMounted } from 'vue';
import { useItemStore } from '~/stores/item';

const store = useItemStore();
const items = ref([]);
const columns = ref([
  { Header: 'ID', accessor: 'id', sortable: true },
  { Header: 'Name', accessor: 'name', sortable: true },
  { Header: 'Category', accessor: 'category.name', sortable: true },
  { Header: 'Unit', accessor: 'unit', sortable: true },
  { Header: 'Price', accessor: 'price', sortable: true },
  { Header: 'Stock', accessor: 'stock', sortable: true },
]);

const page = ref(1);
const totalPages = ref(1);
const isEditModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const editItem = ref({});
const itemToDelete = ref(null);
const sortBy = ref('name'); // Default sort by name
const sortDir = ref('asc'); // Default sort direction

const fetchData = async () => {
  await store.fetch();
  items.value = store.data;
  totalPages.value = Math.ceil(store.total / store.perPage);
};

const handleSort = (column) => {
  if (columns.value.find(col => col.accessor === column).sortable !== false) {
    sortBy.value = column;
    sortDir.value = sortDir.value === 'asc' ? 'desc' : 'asc'; // Toggle sort direction
    fetchData(); // Fetch data with new sort parameters
  }
};

const getValue = (item, accessor) => {
  return accessor.split('.').reduce((o, key) => o?.[key], item);
};

const openEditModal = (item) => {
  editItem.value = { ...item };
  isEditModalOpen.value = true;
};

const closeEditModal = () => {
  isEditModalOpen.value = false;
};

const updateItem = async () => {
  await store.update(editItem.value);
  closeEditModal();
  fetchData();
};

const openDeleteModal = (item) => {
  itemToDelete.value = item;
  isDeleteModalOpen.value = true;
};

const closeDeleteModal = () => {
  isDeleteModalOpen.value = false;
};

const deleteItem = async () => {
  await store.destroy(itemToDelete.value.id);
  closeDeleteModal();
  fetchData();
};

onMounted(() => {
  fetchData();
});
</script>
<template>
  <div>
    <STable>
      <STableHeader>
        <STableRow>
          <STableHead v-for="column in columns" :key="column.accessor" @click="handleSort(column.accessor)"
            :class="{ 'cursor-pointer': column.sortable }">
            {{ column.Header }}
            <span v-if="sortBy === column.accessor">
              {{ sortDir === 'asc' ? '↑' : '↓' }}
            </span>
          </STableHead>
          <STableHead>Aksi</STableHead>
        </STableRow>
      </STableHeader>
      <STableBody>
        <STableRow v-for="item in items" :key="item.id">
          <STableCell v-for="column in columns" :key="column.accessor">
            {{ getValue(item, column.accessor) }}
          </STableCell>
          <STableCell>
            <SButton @click="openEditModal(item)">Edit</SButton>
            <SButton @click="openDeleteModal(item)">Delete</SButton>
          </STableCell>
        </STableRow>
      </STableBody>
    </STable>
    <Pagination :currentPage="page" :totalPages="totalPages" @pageChange="fetchData" />
    <SButton @click="fetchData">Load Data</SButton>

    <!-- Modal Edit -->
    <SDialog v-if="isEditModalOpen" @close="closeEditModal">
      <form @submit.prevent="updateItem">
        <input v-model="editItem.name" placeholder="Name" />
        <input v-model="editItem.price" placeholder="Price" />
        <SButton type="submit">Update</SButton>
      </form>
    </SDialog>

    <!-- Modal Delete Confirmation -->
    <SDialog v-if="isDeleteModalOpen" @close="closeDeleteModal">
      <p>Are you sure you want to delete this item?</p>
      <SButton @click="deleteItem">Yes</SButton>
      <SButton @click="closeDeleteModal">No</SButton>
    </SDialog>
  </div>
</template>

<style scoped>
.cursor-pointer {
  cursor: pointer;
}
</style>

<template>
  <v-autocomplete
    v-model="selectedItems"
    :items="items"
    :loading="loading"
    :search-input.sync="search"
    multiple
    hide-details
    hide-selected
    item-text="name"
    item-value="id"
    clearable
    :disabled="loading"
    label="Select items"
    @update:search-input="fetchItems"
    @update:model-value="emitSelectedItems"
  >
    <template v-slot:prepend-item>
      <v-list-item
        v-if="loading"
        @click="fetchItems"
        :disabled="loading"
      >
        <v-list-item-content>
          <v-list-item-title>
            <v-progress-circular
              v-if="loading"
              indeterminate
              size="24"
            ></v-progress-circular>
            <span v-else>Loading...</span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </template>
  </v-autocomplete>
</template>

<script setup>
import axios from 'axios';
import { defineEmits, defineProps, ref, watch } from 'vue';

const props = defineProps({
  modelValue: {
    type: Array,
    default: () => []
  },
  apiUrl: {
    type: String,
    required: true
  }
});
const emit = defineEmits(['update:modelValue']);

const items = ref([]);
const selectedItems = ref(props.modelValue);
const search = ref(null);
const loading = ref(false);

const fetchItems = async () => {
  if (!search.value) return;

  loading.value = true;
  const apiURL = `${props.apiUrl}?search=${search.value}`;

  try {
    const response = await axios.get(apiURL);
    items.value = response.data;
  } catch (error) {
    items.value = [];
  } finally {
    loading.value = false;
  }
};

const emitSelectedItems = (value) => {
  selectedItems.value = value;
  emit('update:modelValue', value);
};

watch(search, fetchItems);
</script>

<style scoped>
.v-autocomplete .v-input__control .v-input__slot {
  background-color: white;
}
</style>

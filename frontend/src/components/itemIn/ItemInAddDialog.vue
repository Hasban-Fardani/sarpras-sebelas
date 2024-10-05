<script setup lang="ts">
import CustomSelect from '@/components/CustomSelect.vue';
import ItemAddDialog from '@/components/item/ItemAddDialog.vue';
import { useItemStore } from '@/stores/item';
import { useItemInStore } from '@/stores/item_in';
import { useSupplierStore } from '@/stores/supplier';
import type { Item } from '@/types/item';
import { onMounted, ref, watch } from 'vue';

const itemIn = useItemInStore()
const item = useItemStore()
const supplierStore = useSupplierStore()

const items = ref(item.items)
const suppliers = ref(supplierStore.suppliers)
const selectItem = ref(null)
const search = ref('')
const selectedItems = ref<Item[]>([])

const headers = [
    {
        title: 'Gambar',
        key: 'gambar',
    },
    {
        title: 'Barang',
        key: 'name'
    },
    {
        title: 'Jumlah',
        key: 'jumlah'
    }
]
const step = ref(1)
const saveItemIn = () => {
    // itemIn.addItem()
}

const addItem = () => {
    if (selectItem.value == null || selectItem.value === undefined) return

    const i = items.value.filter((i) => i.id === selectItem?.value)[0]

    // check if selectItem item is not already in the list
    if (!selectedItems.value.includes(i)) {
        selectedItems.value.push(i)
    } else {
        console.log("udah ada");           
    }

    // remove items from the list
    items.value.splice(items.value.indexOf(i), 1)
    
    selectItem.value = null
}

const removeItem = (item: Item) => {
    selectedItems.value.splice(selectedItems.value.indexOf(item), 1)
    items.value.push(item)
}

watch(() => search.value, (newVal) => {
    
})

onMounted(() => {
    if (item.items.length === 0) {
        item.getAll()
        items.value = item.items
    }

    if (supplierStore.suppliers.length === 0) {
        supplierStore.getAll()
        suppliers.value = supplierStore.suppliers
    }
})
</script>
<template>
    <v-dialog activator="parent" max-width="500">
        <v-stepper :items="['Isi Data', 'Input barang', 'Review']" v-model="step">
            <template v-slot:item.1>
                <v-card title="Tambah Barang Masuk" prepend-icon="mdi-plus">
                    <v-card-text>
                        <v-file-input 
                            label="dokumen pemeriksaan" 
                            class="mt-1" 
                            density="comfortable"
                        />
                        <v-file-input 
                            label="dokumen berita acara serah terima" 
                            class="mt-1" 
                            density="comfortable"
                        />
                        <v-select 
                            :items="suppliers" 
                            label="supplier" 
                            density="comfortable"
                            item-title="name"
                            item-value="id"
                        />
                        <v-textarea label="deskripsi" rows="3"/>
                    </v-card-text>
                </v-card>
            </template>
            <template v-slot:item.2>    
                <v-btn color="primary" size="small" class="mb-2">
                    barang baru?
                    <item-add-dialog/>
                </v-btn>
                <div class="d-flex flex-wrap justify-start align-center mt-1">
                <div 
                    class="w-100" 
                    v-for="item in selectedItems" 
                    :key="item?.id"
                >
                    <div class="d-flex ga-2 w-100 justify-space-between mt-5">
                        <p class="w-50 mt-4">{{ item.name }}</p>
                        <v-number-input 
                            v-model="item.jumlah" 
                            placeholder="jumlah" 
                            variant="outlined" 
                            controlVariant="stacked" 
                            width="150" 
                            inset required
                        />
                        <v-select 
                            v-model="item.unit"
                            label="unit" 
                            width="150" 
                            variant="outlined" 
                            class="mr-4" 
                            :items="['box', 'rim', 'lusin']" 
                        />
                        <v-btn 
                            icon="mdi-delete" 
                            color="red" 
                            size="small" 
                            class="mt-2" 
                            @click="removeItem(item)"
                        />
                    </div>
                    <v-divider :thickness="2"/>
                </div>
                <div class="d-flex ga-2 w-100 mt-4">
                    <v-autocomplete 
                        v-model="selectItem"
                        label="tambah barang" 
                        item-title="name" 
                        item-value="id"
                        :items="item.items" 
                        :search-input="search"
                    >
                        <template v-slot:item="{ props, item }">
                            <v-list-item v-bind="props" :title="item.raw.name" />
                        </template>
                    </v-autocomplete>
                    <v-btn 
                        icon="mdi-plus" 
                        color="green" 
                        class="mt-2" 
                        @click="addItem" size="small"
                    />
                </div>
            </div>
            </template>
            <template v-slot:item.3>    
                <v-card-text>
                    <v-data-table 
                        :items="selectedItems" 
                        :headers="headers"
                    >
                        <template v-slot:item.gambar="{ item }">
                            <img :src="item.gambar?.toString()" alt="gambar" width="50">
                        </template>
                        <template v-slot:item.jumlah="{ item }">
                            <p>{{ item.jumlah }} {{ item.unit }}</p>
                        </template>
                    </v-data-table>
                </v-card-text>
            </template>
        </v-stepper>
    </v-dialog>
</template>
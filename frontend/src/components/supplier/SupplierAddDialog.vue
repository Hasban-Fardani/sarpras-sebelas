<script setup lang="ts">
import { useSupplierStore } from '@/stores/supplier';
import { ref } from 'vue';

const name = ref('')
const phone = ref('')
const address = ref('')
const saveSupplier = () => {
    const supplier = useSupplierStore();
    supplier.addSupplier({ name: name.value, phone: phone.value, address: address.value });
}
</script>
<template>
    <v-dialog activator="parent" max-width="400">
        <template v-slot:default="{ isActive }">
            <v-card title="Tambah supplier" prepend-icon="mdi-plus">
                <v-card-text>
                    <v-text-field label="Name" v-model="name"></v-text-field>
                </v-card-text>
                <template v-slot:actions>
                    <v-btn class="ml-auto" text="Save" @click="saveSupplier(); isActive.value = false" color="primary"></v-btn>
                    <v-btn text="Close" @click="isActive.value = false;" color="error"></v-btn>
                </template>
            </v-card>
        </template>
    </v-dialog>
</template>
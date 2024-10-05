<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { useItemInStore } from '@/stores/item_in';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';


const itemIn = useItemInStore()
const route = useRoute()
const { id } = route.params

const item = itemIn.items.find((i) => i.id === Number.parseInt(id.toString()))
const detailItemIn = ref(itemIn.item_details)
const headers = [
    {
        title: 'Gambar',
        key: 'item.image',
    },
    {
        title: 'Barang',
        key: 'item.name'
    },
    {
        title: 'Jumlah',
        key: 'qty'
    }
]

onMounted(async () => { 
    await itemIn.getDetails(id.toString())
    detailItemIn.value = itemIn.item_details
})
</script>
<template>
    <AdminLayout>
        <div class="d-flex ga-2">
            <h2>Detail Barang Masuk #{{ id }}</h2>
        </div>
        <div class="d-flex ga-2 my-3">
            <v-avatar color="brown">
                <span class="text-h5">{{ item?.supplier?.name[0] }}</span>
            </v-avatar>
            <div>
                <p>{{ item?.supplier?.name }}</p>
                <p class="font-weight-bold text-caption">{{ item?.created_at }}</p>
            </div>
        </div>
        <VCard class="w-100">
            <VCardText>
                <VDataTable :items="detailItemIn" :headers="headers">
                    <template v-slot:item.item.image="{ item }">
                        <img :src="item.item.image ?? 'https://picsum.photos/200/200'" :alt="'TODO'" width="100px" height="100px">
                    </template>
                </VDataTable>
            </VCardText>
        </VCard>
    </AdminLayout>
</template>
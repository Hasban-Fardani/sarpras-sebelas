<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { useOutgoingItemStore } from '@/stores/outgoing-item';
import { useRoute } from 'vue-router';

const route = useRoute()
const { id } = route.params
const item = useOutgoingItemStore().itemsOut.find((i) => i.id === Number.parseInt(id.toString()))
const detailOutgoingItem = []
const headers = [
    {
        title: 'Gambar',
        key: 'barang.gambar',
    },
    {
        title: 'Barang',
        key: 'barang.name'
    },
    {
        title: 'Jumlah',
        key: 'jumlah'
    }
]
</script>
<template>
    <AdminLayout>
        <div class="d-flex ga-2">
            <h2>Detail Barang Keluar #{{ id }}</h2>
        </div>
        <div class="d-flex justify-space-between w-100">
            <div class="d-flex ga-2 my-3">
                <v-avatar color="brown">
                    <span class="text-h5">{{ item?.unit?.name[0] }}</span>
                </v-avatar>
                <div>
                    <p>{{ item?.unit?.name }}</p>
                    <p class="font-weight-bold text-caption">{{ item?.tanggal }}</p>
                </div>
            </div>
            <div>
                <v-btn>Surat Berita Acara</v-btn>
            </div>
        </div>
        <VCard class="w-100">
            <VCardText>
                <VDataTable :items="detailOutgoingItem" :headers="headers">
                    <template v-slot:item.barang.gambar="{ item }">
                        <img :src="item.barang.gambar ?? 'https://picsum.photos/200/200'" :alt="item.barang.name" width="100px" height="100px">
                    </template>
                </VDataTable>
            </VCardText>
        </VCard>
    </AdminLayout>
</template>
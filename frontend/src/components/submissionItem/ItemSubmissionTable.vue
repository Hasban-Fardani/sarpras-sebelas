<script setup lang="ts">
import DeleteDialog from '@/components/dialogs/DeleteDialog.vue';
import { useItemSubmissionStore } from '@/stores/item_submission';
import { useUserStore } from '@/stores/user';
import { ref } from 'vue';
import DateRangePicker from '../DateRangePicker.vue';


const user = useUserStore()

const itemSubmission = useItemSubmissionStore()
const loading = ref(false)


const confirmDeleteDialog = ref(false)
const selectedDeleteName = ref('')
const selectedDeleteId = ref(0)
const confirmDelete = (id: number, name: string) => {
    confirmDeleteDialog.value = true
    selectedDeleteName.value = name
    selectedDeleteId.value = id
}

const deleteItemSubmission = () => {

}

const getColor = (status: string) => {
    switch (status) {
        case 'diajukan':
            return 'warning'
        case 'ditolak':
            return 'error'
        default:
            return 'success'
    }
}
</script>
<template>
    <delete-dialog 
        type="Pengadaan" 
        :id="selectedDeleteId" 
        :name="selectedDeleteName" 
        :is-active="confirmDeleteDialog"
        @close-dialog="confirmDeleteDialog = false" 
        @delete="deleteItemSubmission" 
    />

    <div class="d-flex flex-wrap w-100 justify-space-between align-center">
        <div class="w-50 w-md-25">
            <v-text-field 
                v-model="itemSubmission.searchName" 
                class="ma-2" 
                label="cari" 
                variant="outlined" 
                density="comfortable"
                placeholder="Cari unit..." 
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
                :items="['diajukan', 'disetujui', 'selesai', 'ditolak']" 
                label="status" 
                variant="outlined" 
                density="comfortable" 
                width="150"
                multiple chips clearable
            />
        </div>
    </div>
    <v-data-table-server 
        v-model:items-per-page="itemSubmission.perPage" 
        :headers="itemSubmission.headers"
        :items="itemSubmission.items" 
        :items-length="itemSubmission.total" 
        :loading="itemSubmission.onUpdate"
        :search="itemSubmission.searchName" 
        item-value="name" 
        @update:options="itemSubmission.updateTable"
    >
        <template v-slot:item.status="{ item }">
            <v-chip :color="getColor(item.status)">{{ item.status }}</v-chip>
        </template>
        <template v-slot:item.id="{ item }">
            <div class="d-flex ga-2">
                <v-btn 
                    icon="mdi-eye" 
                    color="primary" 
                    :to="`/${user.data.role}/pengadaan/${item.id}`" 
                />
                <v-btn 
                    icon="mdi-delete" 
                    color="red"
                    @click="confirmDelete(item.id, 'pengadaan tanggal ' + item.tanggal)" 
                />
            </div>
        </template>
    </v-data-table-server>
</template>
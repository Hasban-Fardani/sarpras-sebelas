<script setup lang="ts">
import ItemRequestTable from '@/components/requestItem/ItemRequestTable.vue';
import RequestForm from '@/components/requestItem/RequestForm.vue';
import UserLayout from '@/layouts/UserLayout.vue';

</script>
<template>
    <UserLayout>
        <v-btn prepend-icon="mdi-plus" color="primary">
            Form Permintaan
            <RequestForm />
        </v-btn>
        <h3 class="mt-3">History Permintaan</h3>
        
            <ItemRequestTable/>
    </UserLayout>
</template>
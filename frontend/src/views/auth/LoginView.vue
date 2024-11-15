<script lang="ts" setup>
import router from '@/router';
import { useUserStore } from '@/stores/user';
import type { Credentials } from '@/types/credential';
import { ref } from 'vue';
import { VSonner, toast } from 'vuetify-sonner';

const valid = ref(false)
const onLoading = ref(false)
const data = ref<Credentials>({
    nip: '',
    password: '',
})
const rules = {
    nip: [
        (v: string) => {
            if (v.length >= 12) return true
            return 'NIP minimal 12 karakter'
        }
    ],
    password: [
        (v: string) => {
            if (v.length >= 6) return true

            return 'Password minimal 6 karakter'
        },
    ]
}

const user = useUserStore()
const login = async () => {
    onLoading.value = true
    const response = await user.login(data.value)
    onLoading.value = false
    if (response.type === 'success') {
        toast.success(response.message, {duration: 2000})
        switch (user.data.role) {
            case 'admin':
                router.push('/admin/dashboard')
                location.reload()
                return
            case 'unit':
                router.push('/user/home')
                location.reload()
                return
            case 'pengawas':
                router.push('/pengawas/dashboard')
                location.reload()
                return
            default:
                return;
        }
    } else {
        toast.error(response.message, {duration: 2000})
    }
}
</script>
<template>
    <v-sonner expand position="top-center"/>
    <div class="w-100 d-flex justify-center align-center h-screen base">
        <div class="w-100 w-md-50 d-flex flex-column justify-center align-center">
            <img src="/logo/icon.svg" width="100" alt="logo sarpras">
            <v-card class="mt-4 w-75">
                <v-card-title class="text-center">Login</v-card-title>
                <v-card-text class="text-center">masukkan data untuk login ke akun anda</v-card-text>
                <v-card-item>
                    <v-form v-model="valid" @submit.prevent="login">
                        <v-text-field label="NIP" v-model="data.nip" :rules="rules.nip" />
                        <v-text-field label="Password" v-model="data.password" :rules="rules.password"
                            type="password" />
                        <v-btn type="submit" color="primary" class="mt-2" v-if="!onLoading">Login</v-btn>
                        <v-btn color="primary" class="mt-2" v-if="onLoading" disabled><v-progress-circular indeterminate></v-progress-circular></v-btn>
                    </v-form>
                </v-card-item>
            </v-card>
        </div>
    </div>
</template>
<style scoped>
.v-card {
    border: solid 1px;
}

.base {
    background-color: rgb(248, 248, 255);
}
</style>
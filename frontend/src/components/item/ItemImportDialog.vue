<script setup lang="ts">
const uploadFile = (file: File) => {
    // Todo upload file
}
</script>
<template>
    <v-dialog activator="parent" max-width="400">
        <template v-slot:default="{ isActive }">
            <v-card title="Import Data" prepend-icon="mdi-import">
                <v-card-text>
                    <p>Tolong upload menggunakan template berikut: <a href="https://docs.google.com/spreadsheets/d/1GgVb5pf9tecriO4vEecagbUiYCXWqASK2SSfWCm3G5U/edit?usp=sharing" target="_blank">Template</a></p>
                    <v-file-input label="input file" class="mt-3" @change="uploadFile"></v-file-input>
                </v-card-text>
                <template v-slot:actions>
                    <v-btn 
                        text="Close" 
                        @click="isActive.value = false"
                    />
                    <v-btn 
                        class="ml-auto" 
                        text="Import" 
                        @click="null" 
                        color="primary" 
                        variant="flat"
                    />
                </template>
            </v-card>
        </template>
    </v-dialog>
</template>
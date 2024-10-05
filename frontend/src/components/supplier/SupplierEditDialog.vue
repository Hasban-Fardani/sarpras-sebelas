<!-- eslint-disable vue/no-mutating-props -->
<script setup lang="ts">
import { useSupplierStore } from "@/stores/supplier";
import type { Supplier } from "@/types/supplier";
import { ref, watch } from "vue";

const props = defineProps<{
	supplierProp: Supplier;
	isActive: boolean;
}>();

const data = ref<Supplier>({
	id: props.supplierProp?.id || 0,
	name: props.supplierProp?.name || "",
	phone: props.supplierProp?.phone || "",
	address: props.supplierProp?.address || "",
});

watch(
	() => props.isActive,
	(newVal) => {
		if (newVal) {
			data.value = { ...props.supplierProp };
		}
	},
);

const saveSupplier = () => {
	const supplier = useSupplierStore();
    supplier.updateSupplier(data.value);
};
</script>

<template>
    <v-dialog v-model="props.isActive" max-width="400">
        <v-card title="Edit supplier" prepend-icon="mdi-pencil">
            <v-card-text>
                <v-text-field label="Name" v-model="data.name"/>
                <v-text-field label="Phone" v-model="data.phone"/>
                <v-text-field label="Address" v-model="data.address"/>
            </v-card-text>
            <template v-slot:actions>
                <v-btn 
                    class="ml-auto" 
                    text="Save" 
                    color="primary"
                    @click="saveSupplier(); $emit('closeDialog')" 
                >Save</v-btn>
                <v-btn 
                    text="Close" 
                    color="error"
                    @click="$emit('closeDialog')" 
                >Close</v-btn>
            </template>
        </v-card>
    </v-dialog>
</template>

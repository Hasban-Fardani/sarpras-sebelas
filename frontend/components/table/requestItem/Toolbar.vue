<script setup lang="ts">
import type { Table } from '@tanstack/vue-table';
import type { ItemRequest } from '~/types/item_request';

type Props = {
  table: Table<ItemRequest>
}

const props = defineProps<Props>();
</script>
<template>
  <div class="flex gap-2 items-center py-4">
      <SInput class="max-w-sm" placeholder="Cari berdasarkan note..."
        :model-value="table.getColumn('employee')?.getFilterValue() as string"
        @update:model-value=" table.getColumn('employee')?.setFilterValue($event)" />
    </div>
</template>
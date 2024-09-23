<script setup lang="ts">
import type { Table } from '@tanstack/vue-table';
import type { ItemSubmission } from '~/types/item_submission';

type Props = {
  table: Table<ItemSubmission>
}

const props = defineProps<Props>();
</script>
<template>
  <div class="flex gap-2 items-center py-4">
      <SInput class="max-w-sm" placeholder="Cari berdasarkan note..."
        :model-value="table.getColumn('note')?.getFilterValue() as string"
        @update:model-value=" table.getColumn('note')?.setFilterValue($event)" />
    </div>
</template>
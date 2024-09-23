<script setup lang="ts">
import type { Table } from '@tanstack/vue-table';
import type { IncomingItem } from '~/types/incoming_items';

type Props = {
  table: Table<IncomingItem>
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
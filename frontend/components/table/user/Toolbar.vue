<script setup lang="ts">
import type { Table } from '@tanstack/vue-table';
import type { User } from '~/types/user';

type Props = {
  table: Table<User>
}

const props = defineProps<Props>();
</script>
<template>
  <div class="flex gap-2 items-center py-4">
      <SInput class="max-w-sm" placeholder="Cari nama..."
        :model-value="table.getColumn('name')?.getFilterValue() as string"
        @update:model-value=" table.getColumn('name')?.setFilterValue($event)" />
    </div>
</template>
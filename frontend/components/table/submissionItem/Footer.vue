<script setup lang="ts">
import type { Table } from '@tanstack/vue-table';
import type { ItemSubmission } from '~/types/item_submission';

type Props = {
  table: Table<ItemSubmission>
}

const props = defineProps<Props>();
</script>
<template>
  <div class="flex items-center justify-end space-x-2 py-4">
    <div>
    </div>
    <div class="space-x-2">
      <SButton variant="outline" size="sm" :disabled="!props.table.getCanPreviousPage()" @click="table.previousPage()">
        Previous
      </SButton>
      <SButton variant="outline" size="sm" :disabled="!props.table.getCanNextPage()" @click="table.nextPage()">
        Next
      </SButton>
    </div>
  </div>
</template>
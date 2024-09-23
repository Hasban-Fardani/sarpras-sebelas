<script setup lang="ts">
import { defineProps } from 'vue'
import type { Item } from '~/types/item'

interface Props {
  table: import("@tanstack/table-core").Table<Item>
}

const props = defineProps<Props>()

const onUpdate = ($event: string | number) => {
  props.table.getColumn('name')?.setFilterValue($event)
}
</script>
<template>
  <div class="flex gap-2 items-center py-4">
    <SInput class="max-w-sm" placeholder="Filter emails..."
      :model-value="table.getColumn('name')?.getFilterValue() as string"
      @update:model-value="onUpdate" />
    <SDropdownMenu>
      <SDropdownMenuTrigger as-child>
        <SButton variant="outline" class="ml-auto">
          Columns
          <ChevronDownIcon class="ml-2 h-4 w-4" />
        </SButton>
      </SDropdownMenuTrigger>
      <SDropdownMenuContent align="end">
        <SDropdownMenuCheckboxItem v-for="column in table.getAllColumns().filter((column) => column.getCanHide())"
          :key="column.id" class="capitalize" :checked="column.getIsVisible()" @update:checked="(value) => {
            column.toggleVisibility(!!value)
          }">
          {{ column.id }}
        </SDropdownMenuCheckboxItem>
      </SDropdownMenuContent>
    </SDropdownMenu>
  </div>
</template>
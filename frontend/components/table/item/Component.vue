<script setup lang="ts">
import { cn } from '~/lib/utils';
import { table } from './table';
import { columns } from './column';
import { FlexRender } from '@tanstack/vue-table';
</script>

<template>
  <div class="w-full">
    <div class="flex gap-2 items-center py-4">
      <SInput class="max-w-sm" placeholder="Filter emails..."
        :model-value="table.getColumn('email')?.getFilterValue() as string"
        @update:model-value=" table.getColumn('email')?.setFilterValue($event)" />
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
    <div class="rounded-md border">
      <STable>
        <STableHeader>
          <STableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
            <STableHead v-for="header in headerGroup.headers" :key="header.id" :data-pinned="header.column.getIsPinned()"
              :class="cn(
                { 'sticky bg-background/95': header.column.getIsPinned() },
                header.column.getIsPinned() === 'left' ? 'left-0' : 'right-0',
              )">
              <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                :props="header.getContext()" />
            </STableHead>
          </STableRow>
        </STableHeader>
        <STableBody>
          <template v-if="table.getRowModel().rows?.length">
            <template v-for="row in table.getRowModel().rows" :key="row.id">
              <STableRow :data-state="row.getIsSelected() && 'selected'">
                <STableCell v-for="cell in row.getVisibleCells()" :key="cell.id" :data-pinned="cell.column.getIsPinned()"
                  :class="cn(
                    { 'sticky bg-background/95': cell.column.getIsPinned() },
                    cell.column.getIsPinned() === 'left' ? 'left-0' : 'right-0',
                  )">
                  <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                </STableCell>
              </STableRow>
              <STableRow v-if="row.getIsExpanded()">
                <STableCell :colspan="row.getAllCells().length">
                  {{ row.original }}
                </STableCell>
              </STableRow>
            </template>
          </template>

          <STableRow v-else>
            <STableCell :colspan="columns.length" class="h-24 text-center">
              No results.
            </STableCell>
          </STableRow>
        </STableBody>
      </STable>
    </div>

    <div class="flex items-center justify-end space-x-2 py-4">
      <div class="flex-1 text-sm text-muted-foreground">
        {{ table.getFilteredSelectedRowModel().rows.length }} of
        {{ table.getFilteredRowModel().rows.length }} row(s) selected.
      </div>
      <div class="space-x-2">
        <SButton variant="outline" size="sm" :disabled="!table.getCanPreviousPage()" @click="table.previousPage()">
          Previous
        </SButton>
        <SButton variant="outline" size="sm" :disabled="!table.getCanNextPage()" @click="table.nextPage()">
          Next
        </SButton>
      </div>
    </div>
  </div>
</template>
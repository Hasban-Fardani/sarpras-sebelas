<script setup lang="ts">
import { FlexRender } from '@tanstack/vue-table'
import { createTable } from './table'
import { columns } from './column'

import Footer from './Footer.vue'
import Toolbar from './Toolbar.vue'
import type { IncomingItem } from '~/types/incoming_items'

type PropsTable = {
  data: IncomingItem[]
  onLoading: boolean
}

const props = defineProps<PropsTable>();
const table = computed(() => createTable(props.data)) 
</script>

<template>
  <div class="w-full">
    <Toolbar :table="table" />
    <div class="rounded-md border">
      <STable>
        <STableHeader>
          <STableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
            <STableHead v-for="header in headerGroup.headers" :key="header.id">
              <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                :props="header.getContext()" />
            </STableHead>
          </STableRow>
        </STableHeader>
        <STableBody>
          <template v-if="table.getRowModel().rows?.length">
            <template v-for="row in table.getRowModel().rows" :key="row.id">
              <STableRow :data-state="row.getIsSelected() && 'selected'">
                <STableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                  <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                </STableCell>
              </STableRow>
              <STableRow v-if="row.getIsExpanded()">
                <STableCell :colspan="row.getAllCells().length">
                  {{ JSON.stringify(row.original) }}
                </STableCell>
              </STableRow>
            </template>
          </template>

          <STableRow v-else-if="props.onLoading">
            <STableCell :colspan="columns.length" class="h-24 text-center">
              <div class=" flex justify-center items-center">
                <div class="animate-spin rounded-full h-10 w-10 border-b-3 border-gray-800"></div>
              </div>
            </STableCell>
          </STableRow>

          <STableRow v-else>
            <STableCell :colspan="columns.length" class="h-24 text-center">
              Tidak ada data.
            </STableCell>
          </STableRow>
        </STableBody>
      </STable>
    </div>
    <Footer :table="table" />
  </div>
</template>
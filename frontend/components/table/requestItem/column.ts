import { ArrowUpDown } from "lucide-vue-next"
import { Button } from "~/components/ui/button"
import type { ColumnDef } from "@tanstack/vue-table"

import DeleteAction from './DeleteAction.vue'
import EditAction from './EditAction.vue'
import type { Employee } from "~/types/employee"
import type { ItemRequest } from "~/types/item_request"

export const columns: ColumnDef<ItemRequest>[] = [
  {
    accessorKey: 'employee',

    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Pengaju', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue<Employee>('employee').name),
    enableSorting: true,
  },
  {
    accessorKey: 'status',

    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Status', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue('status')),
    enableSorting: true,
  },
  {
    accessorKey: 'created_at',

    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Dibuat Tanggal', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue('created_at')),
    enableSorting: true,
  },
  {
    accessorKey: 'id',
    header: () => h('div', { class: 'text-center' }, 'Aksi'),
    cell: ({ row }) => {
      return h('div', { class: 'flex justify-end space-x-2' }, [
        h(EditAction),
        h(DeleteAction, { id: row.getValue('id'), name: row.getValue('name') }),
      ])
    }
  }
]
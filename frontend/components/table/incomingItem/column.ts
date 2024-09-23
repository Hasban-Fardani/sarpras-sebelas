import type { ColumnDef } from "@tanstack/vue-table"
import { ArrowUpDown } from "lucide-vue-next"
import { Button } from "~/components/ui/button"
import type { IncomingItem } from "~/types/incoming_items"

import DeleteAction from './DeleteAction.vue'
import EditAction from './EditAction.vue'
import type { Employee } from "~/types/employee"

export const columns: ColumnDef<IncomingItem>[] = [
  {
    accessorKey: 'employee',

    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Petugas', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue<Employee>('employee').name),
    enableSorting: true,
  },
  {
    accessorKey: 'note',

    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Catatan', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue('note')),
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
import type { ColumnDef } from "@tanstack/vue-table"
import type { Item } from "~/types/item"

export const columns: ColumnDef<Item>[] = [
  {
    accessorKey: 'name',
    header: () => h('p', 'Nama'),
    cell: ({ row }) => {
      return h('div', { class: 'font-medium' }, row.getValue('name'))
    },
  },

  {
    accessorKey: 'price',
    header: () => h('div', { class: 'text-right' }, 'Harga'),
    cell: ({ row }) => {
      const price = Number.parseFloat(row.getValue('price'))
      const formatted = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
      }).format(price)

      return h('div', { class: 'text-right font-medium' }, formatted)
    },
  }
]
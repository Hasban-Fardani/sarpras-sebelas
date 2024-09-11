import type { ColumnDef } from "@tanstack/vue-table"
import { ArrowUpDown, TrashIcon } from "lucide-vue-next"
import { Button } from "~/components/ui/button"
import type { Category } from "~/types/category"
import type { Item } from "~/types/item"

import DeleteAction from './DeleteAction.vue'
import EditAction from './EditAction.vue'

export const columns: ColumnDef<Item>[] = [
  {
    accessorKey: 'image',
    header: 'Gambar',
    cell: ({ row }) => h('img', { src: row.getValue('image'), class: 'w-10 h-10' }),
    enableSorting: false,
  },
  {
    accessorKey: 'name',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Nama', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, row.getValue('name')),
    enableSorting: true,
  },

  {
    accessorKey: 'category',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Kategori', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: 'lowercase' }, row.getValue<Category>('category').name),
  },
  {
    accessorKey: 'stock',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
      }, () => ['Stok / Min.Stok', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => h('div', { class: '' }, [
      h('span', row.getValue('stock')),
      h('span', ' / '),
      h('span', row.getValue('min_stock')),
    ]),
    enableSorting: true,
  },
  {
    accessorKey: 'price',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => {
          const itemStore = useItemStore()
          itemStore.sortBy = column.id
          itemStore.sortDir = column.getIsSorted() === 'asc' ? 'desc' : 'asc'
          itemStore.fetch();
          // column.toggleSorting(column.getIsSorted() === 'asc')
        },
      }, () => ['Harga', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
    },
    cell: ({ row }) => {
      const amount = Number.parseFloat(row.getValue('price'))

      // Format the price as a rupiah
      const formatted = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
      }).format(amount)

      return h('div', { class: 'text-right font-medium' }, formatted)
    },
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
import type { Item } from "./item"

type ItemOut = {
  id: number
  operator_id: number
  operator: {
    id?: number
    name: string
  }
  note: string
  total_items: number
  created_at: Date | string
  updated_at: Date | string
}

type ItemOutDetail = {
  item_out_id: number
  item_id: number
  item: Item
  qty: number
}

export type { ItemOut, ItemOutDetail }

import type { Item } from "./item";

interface OutgoingItem {
  id: number;
  operator_id: number;
  operator: {
    id?: number;
    name: string;
  };
  note: string;
  total_items: number;
  created_at: string;
  updated_at: string;
}

interface OutgoingItemDetail {
  item_out_id: number;
  item_id: number;
  item: Item;
  qty: number;
}

export type { OutgoingItem, OutgoingItemDetail };

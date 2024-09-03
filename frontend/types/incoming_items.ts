import type { Item } from "./item";
import type { Supplier } from "./supplier";
import type { User } from "./user";

interface IncomingItem {
  id: number;
  user_id: number;
  user?: User;
  supplier_id: number;
  supplier?: Supplier;
  note: string;
  created_at: string;
  updated_at: string;
}

interface IncomingItemDetail {
    item_in_id: number
    item_id: number
    item: Item
    sumber_dana: string
    qty: number
}

export type { IncomingItem, IncomingItemDetail }

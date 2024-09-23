import type { Item } from "./item";
import type { Supplier } from "./supplier";
import type { Employee } from "./employee";

interface IncomingItem {
  id: number;
  employee_id: number;
  employee?: Employee;
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

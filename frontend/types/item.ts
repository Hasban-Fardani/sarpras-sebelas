import type { Category } from "./category";

interface Item {
  id: number;
  image?: string;
  name: string;
  category_id?: number;
  category?: Category;
  stock?: number;
  min_stock?: number;
  unit?: string;
  price?: number;
  merk?: string;
  updated_at?: string;
  created_at?: string;
};

export type { Item };

import type { Category } from './category'

type Item = {
  id: number
  code: string
  image?: string | File
  name: string
  unit: string
  merk: string
  type: string
  size: string
  stock: number
  min_stock: number
  price: number
  category_id: number
  category?: Category
  updated_at?: Date | string
}

type CreateItem = {
  code: string
  name: string
  unit: string
  merk: string
  type: string
  size: string
  stock: number
  min_stock: number
  price: number
  category_id: number
  image: File
}

export type { Item, CreateItem }

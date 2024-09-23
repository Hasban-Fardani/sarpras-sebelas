import type { Employee } from './employee'
import type { Item } from './item'

interface ItemSubmission {
  id: number
  division_id: number
  division: Employee
  total_items: number
  status: string
  created_at: string
}

interface ItemSubmissionDetail {
  id: number
  id_pengajuan: number
  id_barang: number
  barang?: Item
  jumlah: number
  jumlah_acc?: number
}

export type { ItemSubmission, ItemSubmissionDetail }

import type { Item } from './item'
import type { User } from './user'

interface ItemSubmission {
  id: number
  id_unit: number
  unit: User
  jumlah_ajuan: number
  status: 'selesai' | 'disetujui' | 'diajukan' | 'ditolak'
  tanggal: string
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

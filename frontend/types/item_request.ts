import type { Item } from "./item";
import type { User } from "./user";

interface ItemRequest {
  id: number;
  division_id: number;
  division: User;
  jumlah_permintaan: number;
  tanggal: string;
  status: "selesai" | "disetujui" | "diajukan" | "ditolak";
  details?: ItemRequestDetail[];
}

interface ItemRequestDetail {
  id: number;
  id_permintaan: number;
  id_barang: number;
  barang: Item;
  jumlah: number;
  jumlah_acc?: number;
}

export type { ItemRequest, ItemRequestDetail }

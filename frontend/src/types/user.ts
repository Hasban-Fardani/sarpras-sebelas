type User = {
  id?: number
  name: string
  token?: string
  unit?: string
  role?: 'admin' | 'unit' | 'pengawas'
  nip?: string
  password?: string
}

export type { User }

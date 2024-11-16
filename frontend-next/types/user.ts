import { Employee } from "./employee"

// interface for user login
export interface UserLogin {
    nip: string
    password: string
}

export interface UserBase extends UserLogin {
    id: string
    username: string
    role: 'admin' | 'unit' | 'pengawas'
}

export interface User extends UserBase {
    employee?: Employee
    created_at?: string
    updated_at?: string
}

export interface UserResponse extends User {
    // TODO: user response structure from api
}

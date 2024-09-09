import type { Employee } from "./employee";

interface User {
    id?: number;
    name: string;
    email?: string;
    role: string;
    employee_id?: string;
    employee: Employee
}

interface UserLogin {
    id: number,
    username: string,
    role: string,
}

export type { User, UserLogin }

import type { Employee } from "./employee";

interface User {
    id?: number;
    name: string;
    email?: string;
    employee_id?: string;
    employee: Employee
}

export type { User }

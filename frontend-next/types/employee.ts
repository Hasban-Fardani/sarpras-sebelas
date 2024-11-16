export interface EmployeeBase {
    id: string
    nip: string
    position: string
}

export interface Employee extends EmployeeBase {
    email: string
    phone?: string
    created_at?: string
    updated_at?: string
}

export interface EmployeeResponse extends Employee {
    // TODO: employee response structure from api response
}

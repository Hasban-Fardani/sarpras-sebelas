export interface ReponseBase<T> {
    message: string
    data: T
}

export interface ResponsePaginate<T> extends ReponseBase<T> {
    path: string
    per_page: number
    current_page: number
    total: number
    from: any
    to: any
    first_page_url: string
    last_page_url: string
    next_page_url?: string
    prev_page_url?: string
}

export interface Response<T> extends ReponseBase<T> {} 

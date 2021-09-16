import axios, { AxiosResponse } from 'axios'
import { Category } from './categories'

export function fetchBooks(category?: string): Promise<AxiosResponse> {
    const params = new URLSearchParams()

    if (category) {
        params.append('category', category)
    }

    return axios.get('/api/books', { params })
}

export interface Book {
    '@id': string
    id: string
    name: string
    description: string
    price: number
    imageFileName: string | null
    category: Category
    author: Author
    formats: Array<Format>
}

export interface Author {
    '@id': string
    id: string
    name: string
}

export interface Format {
    '@id': string
    id: string
    name: string
}

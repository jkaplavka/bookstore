import axios, { AxiosResponse } from 'axios'
import { Category } from './categories'

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

export function fetchBooks(
    category?: string,
    searchTerm?: string
): Promise<AxiosResponse> {
    const params = new URLSearchParams()

    if (category) {
        params.append('category', category)
    }

    if (searchTerm) {
        params.append('name', searchTerm)
    }

    return axios.get('/api/books', { params })
}

export function fetchBook(iri: string): Promise<AxiosResponse> {
    return axios.get(iri)
}

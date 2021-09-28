import axios, { AxiosResponse } from 'axios'
import { Author } from './authors'
import { Category } from './categories'
import { Format } from './formats'

export interface Book {
    '@id'?: string
    id?: string
    name?: string
    description?: string
    price?: number
    stockQuantity?: number
    imageFileName?: string
    category?: Category
    author?: Author
    formats?: Array<Format>
}

export function formatPrice(price: number): string {
    console.log(price)
    return price.toLocaleString('sk-SK', { minimumFractionDigits: 2 })
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

export function createBook(data: Book): Promise<AxiosResponse> {
    return axios.post('/api/books', data)
}

export function updateBook(iri: string, data: Book): Promise<AxiosResponse> {
    return axios.put(iri, data)
}

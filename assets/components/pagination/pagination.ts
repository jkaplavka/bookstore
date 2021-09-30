export default interface Pagination {
    '@id': string
    '@type': string
    'hydra:first': string
    'hydra:last': string
    'hydra:previous'?: string
    'hydra:next'?: string
}

export interface PageChangedEvent {
    page: string
}

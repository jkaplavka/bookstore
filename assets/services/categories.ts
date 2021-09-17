export interface Category {
    '@id': string
    id: string
    name: string
}

export interface Categories extends Array<Category> {}

interface Response {
    data: any
}

export function fetchCategories(): Promise<Response> {
    return new Promise((resolve, reject) => {
        resolve({
            data: {
                'hydra:member': window.categories,
            },
        })
    })
}

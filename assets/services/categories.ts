export interface Category {
    '@id': string
    name: string
}

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

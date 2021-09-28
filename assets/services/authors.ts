export interface Author {
    '@id': string
    id: string
    name: string
}

interface Response {
    data: any
}

export function fetchAuthors(): Promise<Response> {
    return new Promise((resolve, reject) => {
        resolve({
            data: {
                'hydra:member': window.authors,
            },
        })
    })
}

export interface Format {
    '@id': string
    id: string
    name: string
}

interface Response {
    data: any
}

export function fetchFormats(): Promise<Response> {
    return new Promise((resolve, reject) => {
        resolve({
            data: {
                'hydra:member': window.formats,
            },
        })
    })
}

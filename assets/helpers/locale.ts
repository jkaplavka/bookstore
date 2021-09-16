export function formatPrice(price: number): string {
    return price.toLocaleString('sk-SK', { minimumFractionDigits: 2 })
}

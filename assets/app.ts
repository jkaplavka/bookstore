/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import { Author } from './services/authors'
import { Category } from './services/categories'
import { Format } from './services/formats'
import './styles/app.scss'

require('bootstrap')

declare module '@vue/runtime-core' {
    export interface ComponentCustomProperties {
        $style: { [key: string]: string }
    }
}

declare global {
    interface Window {
        currentCategoryId?: string
        currentBookId: string | null
        categories: Array<Category>
        authors: Array<Author>
        formats: Array<Format>
    }
}

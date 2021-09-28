<template>
    <form @submit.prevent="onSubmit">
        <div v-show="serverError" class="alert alert-danger">
            We are sorry something went wrong! Please try again!
        </div>
        <input-text
            id="name"
            label="Name"
            :error-message="validationErrors.name"
            v-model.trim="form.name"
        />
        <div class="row">
            <div class="col">
                <input-select
                    id="author"
                    label="Author"
                    :options="authorsOptions"
                    :error-message="validationErrors.author"
                    v-model="form.author"
                />
            </div>
            <div class="col">
                <input-select
                    id="category"
                    label="Category"
                    :options="categoriesOptions"
                    :error-message="validationErrors.category"
                    v-model="form.category"
                />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input-text
                    id="price"
                    label="Price"
                    :error-message="validationErrors.price"
                    text-after="€"
                    type="number"
                    min="0.00"
                    step="0.01"
                    v-model.number="form.price"
                />
            </div>
            <div class="col">
                <input-text
                    id="stockQuantity"
                    label="Stock Quantity"
                    :error-message="validationErrors.stockQuantity"
                    type="number"
                    min="0"
                    v-model.number="form.stockQuantity"
                />
            </div>
        </div>
        <input-text-area
            id="description"
            label="Description"
            :error-message="validationErrors.description"
            v-model.trim="form.description"
        />
        <input-select-multi
            id="formats"
            label="Format"
            :options="formatsOptions"
            :error-message="validationErrors.formats"
            v-model="form.formats"
        />
        <button class="btn btn-primary" type="submit" :disabled="loading">
            <span
                v-show="loading"
                class="spinner-border spinner-border-sm me-2"
                role="status"
                aria-hidden="true"
            ></span>
            {{ this.book ? 'Save' : 'Create book' }}
        </button>
    </form>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import { Category } from '../../../services/categories'
import InputText from '@/components/admin/form/input-text.vue'
import InputTextArea from '@/components/admin/form/input-textarea.vue'
import InputSelect from '@/components/admin/form/input-select.vue'
import InputSelectMulti from '@/components/admin/form/input-select-multi.vue'
import { Author } from '../../../services/authors'
import { Format } from '../../../services/formats'
import { Book, createBook, updateBook } from '../../../services/books'
import axios from 'axios'

interface ValidationErrors {
    [key: string]: string
}

interface ValidationViolation {
    propertyPath: string
    message: string
}

export default defineComponent({
    name: 'BookForm',
    components: {
        InputText,
        InputTextArea,
        InputSelect,
        InputSelectMulti,
    },
    data: () => ({
        form: {
            name: undefined as string | undefined,
            author: undefined as string | undefined,
            category: undefined as string | undefined,
            description: undefined,
            price: undefined as Number | undefined,
            stockQuantity: undefined as Number | undefined,
            formats: [] as string[] | undefined,
        },
        validationErrors: {} as ValidationErrors,
        serverError: false,
        loading: false,
    }),
    props: {
        authors: {
            type: Array as PropType<Array<Author>>,
            required: true,
        },
        categories: {
            type: Array as PropType<Array<Category>>,
            required: true,
        },
        formats: {
            type: Array as PropType<Array<Format>>,
            required: true,
        },
        book: {
            type: Object as PropType<Book>,
            default: null,
        },
    },
    computed: {
        authorsOptions() {
            return this.authors.map((a) => ({
                label: a.name,
                value: a['@id'],
            }))
        },
        categoriesOptions() {
            return this.categories.map((c) => ({
                label: c.name,
                value: c['@id'],
            }))
        },
        formatsOptions() {
            return this.formats.map((f) => ({
                label: f.name,
                value: f['@id'],
            }))
        },
    },
    methods: {
        async onSubmit() {
            this.loading = true
            this.serverError = false

            try {
                let response
                if (this.book) {
                    response = await updateBook(this.book['@id']!, {
                        ...this.form,
                    } as Book)
                } else {
                    response = await createBook({
                        ...this.form,
                    } as Book)
                }

                this.validationErrors = {}

                if (response.status === 201) {
                    this.$emit('book-created', { book: response.data as Book })
                }
            } catch (error) {
                if (axios.isAxiosError(error)) {
                    const { response } = error

                    if (response?.status === 422) {
                        this.validationErrors = {}
                        response.data.violations.forEach(
                            (violation: ValidationViolation) => {
                                this.validationErrors[violation.propertyPath] =
                                    violation.message
                            }
                        )
                    } else {
                        this.serverError = true
                    }
                }
            } finally {
                this.loading = false
            }
        },
        loadBook() {
            if (this.book) {
                this.form.name = this.book.name
                this.form.price = this.book.price
                this.form.stockQuantity = this.book.stockQuantity
                this.form.author = this.book.author
                    ? this.book.author['@id']
                    : undefined
                this.form.category = this.book.category
                    ? this.book.category['@id']
                    : undefined
                this.form.formats = this.book.formats?.map(
                    (f: Format) => f['@id']
                )
            } else {
                this.form = {
                    name: undefined,
                    author: undefined,
                    category: undefined,
                    description: undefined,
                    price: undefined,
                    stockQuantity: undefined,
                    formats: [],
                }
            }
        },
    },
    created() {
        this.loadBook()
    },
    watch: {
        book() {
            this.loadBook()
        },
    },
})
</script>



<template>
    <div class="card mb-4">
        <div class="card-body pb-0">
            <table class="table mb-0">
                <caption>
                    <pagination-component
                        v-show="!loading"
                        :pagination="pagination"
                        @page-changed="onPageChanged"
                    />
                </caption>
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="d-flex">
                                <div class="me-auto lh-lg">Title</div>
                            </div>
                        </th>
                        <th scope="col" class="col-md-3">
                            <div class="d-flex">
                                <div class="me-auto lh-lg">Category</div>
                                <filter-component
                                    property="category"
                                    :values="categoriesOptions"
                                    :selected="filterCategories"
                                    @filter-changed="onFilterChanged"
                                />
                            </div>
                        </th>
                        <th scope="col" class="col-md-1">
                            <div class="d-flex">
                                <div class="me-auto lh-lg">Price</div>
                            </div>
                        </th>
                        <th scope="col" class="col-md-1">
                            <div class="d-flex">
                                <div class="me-auto lh-lg">Stock</div>
                            </div>
                        </th>
                        <th scope="col" class="col-md-1">
                            <div class="d-flex">
                                <div class="me-auto lh-lg">Actions</div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody v-show="loading">
                    <tr>
                        <td colspan="5">
                            <loading />
                        </td>
                    </tr>
                </tbody>
                <tbody v-show="!loading">
                    <tr v-for="book in books" :key="book.id">
                        <td>{{ book.name }}</td>
                        <td>{{ book.category.name }}</td>
                        <td class="text-end">{{ price(book.price ?? 0) }}</td>
                        <td class="text-end">{{ book.stockQuantity }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import FilterComponent from '@/components/filter/filter-check.vue'
import Loading from '@/components/loading.vue'
import PaginationComponent from '@/components/pagination/pagination.vue'
import Pagination, { PageChangedEvent } from '../../pagination/pagination'
import { FilterChangedEvent } from '../../filter/filterEvents'
import { Book, fetchBooks, formatPrice } from '../../../services/books'
import { Category } from '../../../services/categories'

export default defineComponent({
    name: 'BookList',
    components: {
        FilterComponent,
        Loading,
        PaginationComponent,
    },
    data: () => ({
        books: [] as PropType<Array<Book>>,
        filterCategories: [] as string[] | undefined,
        pagination: undefined as Pagination | undefined,
        page: '1',
        loading: true,
    }),
    props: {
        categories: {
            type: Array as PropType<Array<Category>>,
            required: true,
        },
    },
    async created() {
        this.readQueryOarams()
        this.loadBooks()

        window.onpopstate = this.onPopState
    },
    computed: {
        categoriesOptions() {
            return this.categories.map((c) => ({
                label: c.name,
                value: c['@id'],
            }))
        },
    },
    methods: {
        async loadBooks() {
            this.loading = true

            let response
            try {
                response = await fetchBooks(this.page, this.filterCategories)
                this.loading = false
            } catch (error) {
                this.loading = false
                return
            }

            this.books = response.data['hydra:member']
            this.pagination = response.data['hydra:view'] as Pagination
        },
        readQueryOarams() {
            const url = new URL(document.location.href)

            if (url.searchParams.get('page')) {
                this.page = url.searchParams.get('page')!
            }
            if (url.searchParams.get('categories')) {
                this.filterCategories = url.searchParams
                    .get('categories')!
                    .split(',')
            }
        },
        updateQueryParams() {
            const url = new URL(document.location.href)

            url.searchParams.set('page', this.page)
            url.searchParams.set('categories', this.filterCategories!.join(','))

            window.history.pushState(null, '', url.toString())
        },
        onPopState(event: PopStateEvent) {
            this.readQueryOarams()
            this.loadBooks()
        },
        onPageChanged(event: PageChangedEvent) {
            this.page = event.page
            this.loadBooks()
        },
        onFilterChanged(event: FilterChangedEvent) {
            this.filterCategories = event.values
            this.page = '1'
            this.loadBooks()
        },
        price(price: number) {
            return formatPrice(price)
        },
    },
    watch: {
        page() {
            this.updateQueryParams()
        },
        filterCategories() {
            this.updateQueryParams()
        },
    },
})
</script>

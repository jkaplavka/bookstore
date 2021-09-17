<template>
    <div>
        <div class="container px-0 border-bottom">
            <nav class="navbar navbar-light bg-white">
                <div class="container-fluid">
                    <breadcrumbs :category="currentCategory" />
                    <filters @filter-search="onSearchBooks" />
                </div>
            </nav>
        </div>

        <list-component
            :books="books"
            :loading="loading"
            :total-items="totalItems"
        />
        <!-- pagination -->
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import ListComponent from '@/components/book-catalog/list.vue'
import Breadcrumbs from '@/components/breadcrumbs.vue'
import Filters from '@/components/book-catalog/filters.vue'
import SearchBooksEvent from '../../components/book-catalog/events/SearchBooksEvent'
import { fetchBooks } from '../../services/books'
import { Category, Categories } from '../../services/categories'

export default defineComponent({
    name: 'BooksCatalog',
    components: {
        ListComponent,
        Breadcrumbs,
        Filters,
    },
    data: () => ({
        books: [],
        loading: false,
        searchTerm: '',
        totalItems: 0,
    }),
    props: {
        categories: {
            type: Array as PropType<Categories>,
            required: true,
        },
        currentCategoryId: {
            type: String,
            requred: true,
        },
    },
    computed: {
        currentCategory(): Category | null {
            let category

            if (this.currentCategoryId) {
                category = this.categories.find<Category>(
                    (obj): obj is Category => obj.id === this.currentCategoryId
                )
            }

            return category ? category : null
        },
    },
    async created() {
        this.loadBooks()
    },
    watch: {
        currentCategoryId() {
            this.loadBooks()
        },
    },
    methods: {
        onSearchBooks(event: SearchBooksEvent) {
            this.searchTerm = event.term
            this.loadBooks()
        },
        async loadBooks() {
            this.loading = true

            let response
            try {
                response = await fetchBooks(
                    this.currentCategoryId,
                    this.searchTerm
                )
                this.loading = false
            } catch (error) {
                this.loading = false
                return
            }

            this.books = response.data['hydra:member']
            this.totalItems = response.data['hydra:totalItems']
        },
    },
})
</script>

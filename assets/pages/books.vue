<template>
    <div>
        <nav-bar />

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar-->
                <div class="col-2 px-sm-2 px-0 bg-dark">
                    <side-bar
                        :categories="categories"
                        :current-category-id="currentCategoryId"
                    />
                </div>

                <!-- Content-->
                <section class="col-10 py-4 bg-light">
                    <component
                        :is="currentComponent"
                        v-bind="currentComponentProps"
                    />
                </section>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import BooksList from '@/components/books-list/index.vue'
import BookDetail from '@/components/book-detail/index.vue'
import NavBar from '@/components/nav-bar.vue'
import SideBar from '@/components/side-bar.vue'
import {
    getCurrentBookId,
    getCurrentCategoryId,
} from '../services/page-context'
import { fetchCategories } from '../services/categories'
import { fetchBooks } from '../services/books'

export default defineComponent({
    name: 'Books',
    components: {
        BooksList,
        BookDetail,
        NavBar,
        SideBar,
    },
    data: () => ({
        books: [],
        categories: [],
        currentBookId: getCurrentBookId(),
        currentCategoryId: getCurrentCategoryId(),
        loading: false,
    }),
    computed: {
        currentComponent() {
            return this.currentBookId !== null ? BookDetail : BooksList
        },
        currentComponentProps() {
            return this.currentBookId !== null
                ? {
                      bookId: this.currentBookId,
                  }
                : {
                      books: this.books,
                  }
        },
    },
    async created() {
        const response = await fetchCategories()
        this.categories = response.data['hydra:member']
        this.loadBooks(this.currentCategoryId)
    },
    methods: {
        async loadBooks(category?: string) {
            this.loading = true

            let response
            try {
                response = await fetchBooks(category)
                this.loading = false
            } catch (error) {
                this.loading = false
                return
            }

            this.books = response.data['hydra:member']
        },
    },
})
</script>

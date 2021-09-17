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
                <section class="col-10 pb-4 px-0 bg-light">
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
import BooksList from '@/components/book-catalog/index.vue'
// import SearchBooksEvent from '../components/books-list/events/SearchBooksEvent'
import BookDetail from '@/components/book-detail/index.vue'
import NavBar from '@/components/nav-bar.vue'
import SideBar from '@/components/side-bar.vue'
import {
    getCurrentBookId,
    getCurrentCategoryId,
} from '../services/page-context'
import { fetchCategories } from '../services/categories'

export default defineComponent({
    name: 'Books',
    components: {
        BooksList,
        BookDetail,
        NavBar,
        SideBar,
    },
    data: () => ({
        categories: [],
        currentBookId: getCurrentBookId(),
        currentCategoryId: getCurrentCategoryId(),
    }),
    computed: {
        currentComponent() {
            return this.currentBookId !== null ? BookDetail : BooksList
        },
        currentComponentProps() {
            return this.currentBookId !== null
                ? {
                      currentBookIri: this.currentBookId,
                  }
                : {
                      categories: this.categories,
                      currentCategoryId: this.currentCategoryId,
                  }
        },
    },
    async created() {
        const response = await fetchCategories()
        this.categories = response.data['hydra:member']
    },
})
</script>

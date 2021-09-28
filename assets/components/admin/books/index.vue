<template>
    <div>
        <loading v-show="loading" />
        <div v-if="!loading">
            <breadcrumbs title="Books" :path="breadcrumbs" />
            <book-list />
            <!-- <book-form
                        :authors="authors"
                        :categories="categories"
                        :formats="formats"
                        :book="book"
                    /> -->
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import BookForm from '@/components/admin/books/form.vue'
import BookList from '@/components/admin/books/list.vue'
import Breadcrumbs from '@/components/admin/breadcrumbs.vue'
import Loading from '@/components/loading.vue'
import BreadcrumbsPath from './../breadcrumbsPath'
import { Category, fetchCategories } from '../../../services/categories'
import { Author, fetchAuthors } from '../../../services/authors'
import { Format, fetchFormats } from '../../../services/formats'
import { Book, fetchBook } from '../../../services/books'

export default defineComponent({
    name: 'BookAdmin',
    components: {
        BookForm,
        BookList,
        Breadcrumbs,
        Loading,
    },
    data: () => ({
        authors: [] as PropType<Array<Author>>,
        categories: [] as PropType<Array<Category>>,
        formats: [] as PropType<Array<Format>>,
        book: undefined as Book | undefined,
        loading: false,
    }),
    props: {
        id: {
            type: String,
            default: null,
        },
    },
    computed: {
        breadcrumbs() {
            let path = []

            path.push({
                label: 'Books',
            } as BreadcrumbsPath)

            return path
        },
    },
    watch: {
        id() {
            this.loadBook()
        },
    },
    async created() {
        this.authors = (await fetchAuthors()).data['hydra:member']
        this.categories = (await fetchCategories()).data['hydra:member']
        this.formats = (await fetchFormats()).data['hydra:member']

        this.loadBook()
    },
    methods: {
        async loadBook() {
            if (this.id) {
                try {
                    this.loading = true
                    this.book = (await fetchBook(`/api/books/${this.id}`)).data
                    // TODO: fix path, error handling
                } finally {
                    this.loading = false
                }
            } else {
                this.book = undefined
            }
        },
    },
})
</script>

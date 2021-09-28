<template>
    <div class="card mb-4">
        <div class="card-body pb-0">
            <table class="table mb-0">
                <caption>
                    <nav aria-label="Pagination" class="">
                        <ul
                            class="
                                pagination pagination-sm
                                justify-content-center
                                mt-3
                                mb-2
                            "
                        >
                            <li class="page-item">
                                <a
                                    class="page-link"
                                    href="#"
                                    aria-label="Previous"
                                >
                                    <span aria-hidden="true">&lt;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&gt;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
                                <filter-component />
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
import { Book, fetchBooks, formatPrice } from '../../../services/books'

export default defineComponent({
    name: 'BookList',
    components: { FilterComponent, Loading },
    data: () => ({
        books: [] as PropType<Array<Book>>,
        loading: true,
    }),
    async created() {
        this.loadBooks()
    },
    methods: {
        async loadBooks() {
            this.loading = true

            let response
            try {
                response = await fetchBooks()
                this.loading = false
            } catch (error) {
                this.loading = false
                return
            }

            this.books = response.data['hydra:member']
        },
        price(price: number) {
            return formatPrice(price)
        },
    },
})
</script>

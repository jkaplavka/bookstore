<template>
    <pagination />
    <div class="container mt-1">
        <div
            class="
                row
                gx-4 gx-lg-5
                row-cols-2 row-cols-md-3 row-cols-xl-4
                justify-content-center
            "
        >
            <book-item v-for="book in books" :key="book.id" />
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import BookItem from '@/components/books-list/item.vue'
import Pagination from '@/components/pagination.vue'

export default defineComponent({
    name: 'BooksList',
    components: {
        BookItem,
        Pagination,
    },
    data: () => ({
        books: [
            {
                id: '1',
            },
            {
                id: '2',
            },
            {
                id: '3',
            },
            {
                id: '4',
            },
        ],
    }),
})
</script>

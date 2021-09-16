<template>
    <pagination />
    <div class="container mt-1">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                <book-item v-for="book in books" :key="book.id" :book="book" />
            </div>
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
    props: {
        books: {
            type: Array,
            required: true,
        },
    },
})
</script>

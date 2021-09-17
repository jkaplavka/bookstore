<template>
    <div>
        <loading v-show="loading" />
        <div class="container my-4">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    <h5 v-show="!loading && books.length === 0">
                        No books found!
                    </h5>
                    <book-item
                        v-for="book in books"
                        :key="book.id"
                        :book="book"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import BookItem from '@/components/book-catalog/item.vue'
import Loading from '@/components/loading.vue'

export default defineComponent({
    name: 'BooksList',
    components: {
        BookItem,
        Loading,
    },
    props: {
        books: {
            type: Array,
            required: true,
        },
        loading: {
            type: Boolean,
            default: true,
        },
    },
})
</script>

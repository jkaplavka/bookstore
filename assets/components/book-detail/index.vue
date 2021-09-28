<template>
    <div :class="$style.component">
        <div class="container px-0 border-bottom">
            <nav class="navbar navbar-light bg-white">
                <div class="container-fluid">
                    <breadcrumbs :category="book.category" />
                </div>
            </nav>
        </div>
        <loading v-show="loading" />
        <div class="container px-4 px-lg-5 my-5" v-if="!loading && book">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6 text-center">
                    <img
                        class="card-img-top mb-5 mb-md-0"
                        :src="image"
                        alt="..."
                    />
                </div>
                <div class="col-md-6">
                    <div class="small mb-1">SKU: {{ book.id }}</div>
                    <h1 class="display-6 fw-bolder">{{ book.name }}</h1>
                    <div class="fs-5 mb-5">
                        <span>{{ price }} €</span>
                    </div>
                    <p class="lead">
                        {{ description }}
                    </p>
                    <div class="d-flex">
                        <input
                            class="form-control text-center me-3"
                            id="inputQuantity"
                            type="num"
                            value="1"
                            style="max-width: 3rem"
                        />
                        <button
                            class="btn btn-outline-dark flex-shrink-0 disabled"
                            type="button"
                        >
                            <i class="bi-cart-fill me-1"></i>
                            Out of stock
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- <similiar-books /> -->
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { truncate } from 'lodash'
import Breadcrumbs from '@/components/breadcrumbs.vue'
import SimiliarBooks from '@/components/book-detail/similiar-books.vue'
import Loading from '@/components/loading.vue'
import { Book, fetchBook, formatPrice } from '../../services/books'

export default defineComponent({
    name: 'BookDetail',
    components: {
        SimiliarBooks,
        Breadcrumbs,
        Loading,
    },
    props: {
        currentBookIri: {
            type: String,
            required: true,
        },
    },
    data: () => ({
        book: {} as Book,
        loading: true,
    }),
    computed: {
        description() {
            return truncate(this.book.description, {
                length: 600,
            })
        },
        price() {
            if (this.book.price) {
                return formatPrice(this.book.price)
            }
        },
        image() {
            return this.book.imageFileName !== null
                ? this.book.imageFileName
                : '/images/books/_placeholder_book.jpg'
        },
    },
    async created() {
        try {
            this.book = (await fetchBook(this.currentBookIri)).data
        } finally {
            this.loading = false
        }
    },
})
</script>

<style lang="scss" module>
.component :global {
    .card-img-top {
        width: auto;
        max-height: 400px;
    }
}
</style>

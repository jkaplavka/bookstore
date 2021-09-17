<template>
    <div
        :class="[
            $style.component,
            'row',
            'p-2',
            'mb-4',
            'bg-white',
            'border',
            'rounded',
        ]"
    >
        <div class="col-md-3 mt-2 mb-2 text-center">
            <a :href="detailsUrl">
                <img
                    class="img-fluid img-responsive rounded product-image"
                    style="max-height: 240px"
                    :src="image"
                />
            </a>
        </div>
        <div class="col-md-6 mt-1">
            <h4 class="mb-0 fw-bold">{{ book.name }}</h4>
            <p class="fs-6">
                by
                <a :href="`/author/${book.author.id}`">
                    {{ book.author.name }}
                </a>
            </p>
            <p class="description mb-0" style="min-height: 155px">
                {{ description }}
            </p>

            <div class="mt-1 mb-1 spec-1">
                <ul class="list-inline list-inline-dotted mb-0">
                    <li class="list-inline-item fw-bold">Formats:</li>
                    <li
                        class="list-inline-item"
                        v-for="format in book.formats"
                        :key="format.id"
                    >
                        <a class="text-muted text-decoration-none">
                            {{ format.name }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div
            class="
                align-items-center align-content-center
                col-md-3
                border-start
                mt-1
            "
        >
            <div class="text-center">
                <h4 class="mt-3">{{ price }} €</h4>
                <div class="text-warning">
                    <i class="bi-star-fill"></i>
                    <i class="bi-star-fill"></i>
                    <i class="bi-star-fill"></i>
                    <i class="bi-star-fill"></i>
                    <i class="bi-star"></i>
                </div>
                <div class="text-muted">388 reviews</div>
            </div>
            <div class="d-flex flex-column mt-5">
                <a
                    :href="detailsUrl"
                    class="btn btn-primary btn-sm"
                    role="button"
                >
                    Details
                </a>
                <button
                    class="btn btn-outline-primary btn-sm mt-2"
                    type="button"
                >
                    Add to wishlist
                </button>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import { truncate } from 'lodash'
import { Book } from '../../services/books'
import { formatPrice } from '../../helpers/locale'

export default defineComponent({
    name: 'BooksListItem',
    props: {
        book: {
            type: Object as PropType<Book>,
            required: true,
        },
    },
    computed: {
        price() {
            return formatPrice(this.book.price)
        },
        image() {
            return this.book.imageFileName !== null
                ? this.book.imageFileName
                : '/images/books/_placeholder_book.jpg'
        },
        detailsUrl() {
            return `/book/${this.book.id}`
        },
        description() {
            return truncate(this.book.description, {
                length: 200,
            })
        },
    },
})
</script>

<style lang="scss" module>
.component :global {
    .description {
        font-size: 14px;
    }
}
</style>

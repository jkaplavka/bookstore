<template>
    <nav aria-label="Pagination" class="">
        <ul class="pagination pagination-sm justify-content-end mt-3 mb-2">
            <li
                :class="{
                    'page-item': true,
                    disabled: !previous,
                }"
            >
                <a
                    class="page-link"
                    href="#"
                    @click.prevent="onPreviousClicked"
                    aria-label="Previous"
                >
                    <span aria-hidden="true">&lt;</span>
                </a>
            </li>
            <li
                :class="{
                    'page-item': true,
                    disabled: !next,
                }"
            >
                <a
                    class="page-link"
                    href="#"
                    aria-label="Next"
                    @click.prevent="onNextClicked"
                >
                    <span aria-hidden="true">&gt;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import Pagination from './pagination'

export default defineComponent({
    name: 'PaginationComponent',
    data: () => ({
        next: undefined as URL | undefined,
        previous: undefined as URL | undefined,
    }),
    props: {
        pagination: {
            type: Object as PropType<Pagination>,
            default: undefined,
        },
    },
    watch: {
        pagination() {
            this.next = undefined
            this.previous = undefined

            if (this.pagination?.['hydra:next']) {
                this.next = new URL(`https://${this.pagination['hydra:next']}`)
            }
            if (this.pagination?.['hydra:previous']) {
                this.previous = new URL(
                    `https://${this.pagination['hydra:previous']}`
                )
            }
        },
    },
    methods: {
        onNextClicked() {
            if (this.next) {
                const page = this.next.searchParams.get('page') ?? '1'
                this.$emit('page-changed', { page })
            }
        },
        onPreviousClicked() {
            if (this.previous) {
                const page = this.previous.searchParams.get('page') ?? '1'
                this.$emit('page-changed', { page })
            }
        },
    },
})
</script>

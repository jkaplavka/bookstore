<template>
    <nav
        class="fs-3"
        style="--bs-breadcrumb-divider: '>'"
        aria-label="breadcrumb"
    >
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none link-secondary">
                    All Books
                </a>
            </li>
            <li
                class="breadcrumb-item active"
                aria-current="page"
                v-if="category"
            >
                <a
                    :href="`/category/${category.id}`"
                    class="text-decoration-none link-secondary"
                >
                    {{ category.name }}
                </a>
            </li>
        </ol>
    </nav>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import { Category } from '../services/categories'

export default defineComponent({
    name: 'Breadcrumbs',
    props: {
        category: {
            type: Object as PropType<Category>,
            default: null,
        },
    },
})
</script>

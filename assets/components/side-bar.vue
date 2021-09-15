<template>
    <div
        class="
            d-flex
            flex-column
            align-items-center align-items-sm-start
            px-3
            pt-2
            min-vh-100
            navbar-dark
        "
    >
        <span class="fs-5 d-none d-sm-inline text-white mb-2">Categories</span>
        <ul class="navbar-nav flex-column">
            <li class="nav-item ps-3">
                <a class="nav-link active" href="/">Best Sellers</a>
            </li>
            <li
                v-for="category in categories"
                :key="category['@id']"
                class="nav-item ps-3"
            >
                <a class="nav-link" :href="`/category/${category.id}`">
                    {{ category.name }}
                </a>
            </li>
        </ul>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'SideBar',
    props: {
        categories: {
            type: Array,
            required: true,
        },
    },
})
</script>

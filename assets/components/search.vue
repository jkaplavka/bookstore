<template>
    <form class="d-flex">
        <input
            class="
                form-control
                me-2
                text-light
                border-light
                bg-dark
                shadow-none
            "
            type="search"
            placeholder="Search"
            aria-label="Search"
        />
        <button class="btn btn-outline-light" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'Search',
})
</script>

<template>
    <form class="d-flex">
        <!-- Search -->
        <input
            v-model="searchTerm"
            class="form-control me-2"
            type="search"
            placeholder="Search books..."
            aria-label="Search books..."
            @input="onInput"
        />

        <!-- Sort By -->
        <!-- <div class="input-group me-2">
            <label class="input-group-text" for="sortBySelect"> Sort By </label>
            <select class="form-select" id="sortBySelect">
                <option selected value="name-asc">Name</option>
                <option value="price-asc">Price - Low to High</option>
                <option value="price-desc">Price - High to Low</option>
            </select>
        </div> -->

        <!-- More filters -->
        <!-- <button class="btn btn-outline-secondary" type="submit">
            <i class="bi-funnel me-1"></i>
        </button> -->
    </form>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'Filters',
    data: () => ({
        searchTerm: '',
        searchTimeout: null as NodeJS.Timeout | null,
    }),
    methods: {
        onInput() {
            if (this.searchTimeout) {
                clearTimeout(this.searchTimeout)
            }

            this.searchTimeout = setTimeout(() => {
                this.$emit('filter-search', { term: this.searchTerm })
                this.searchTimeout = null
            }, 500)
        },
    },
})
</script>

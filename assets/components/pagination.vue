<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="fs-5 py-2">Best Sellers (4)</h1>
            </div>
            <div class="col">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li
                            class="
                                page-item
                                link-secondary
                                shadow-none
                                disabled
                            "
                        >
                            <a
                                class="page-link"
                                href="#"
                                tabindex="-1"
                                aria-disabled="true"
                                >Previous</a
                            >
                        </li>
                        <li class="page-item">
                            <a
                                class="page-link link-secondary shadow-none"
                                href="#"
                                >1</a
                            >
                        </li>
                        <li class="page-item">
                            <a
                                class="page-link link-secondary shadow-none"
                                href="#"
                                >2</a
                            >
                        </li>
                        <li class="page-item">
                            <a
                                class="page-link link-secondary shadow-none"
                                href="#"
                                >3</a
                            >
                        </li>
                        <li class="page-item">
                            <a
                                class="page-link link-secondary shadow-none"
                                href="#"
                                >Next</a
                            >
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'Pagination',
})
</script>

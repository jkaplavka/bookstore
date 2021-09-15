<template>
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Product image-->
            <a href="/book/01f2d431-966d-4eb6-babe-49161c81707a"
                ><img
                    class="card-img-top"
                    src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg"
                    alt="..."
            /></a>
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <a
                        href="/book/01f2d431-966d-4eb6-babe-49161c81707a"
                        class="link-secondary text-decoration-none"
                    >
                        <h5 class="fw-bolder">Popular Item</h5>
                    </a>
                    <!-- Product reviews-->
                    <div
                        class="
                            d-flex
                            justify-content-center
                            small
                            text-warning
                            mb-2
                        "
                    >
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star"></div>
                    </div>
                    <!-- Product price-->
                    40.00 €
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                    <a class="btn btn-outline-dark mt-auto" href="#"
                        >Out of stock</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'BooksListItem',
})
</script>

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
        <div class="col-md-3 mt-2 mb-2">
            <img
                class="img-fluid img-responsive rounded product-image"
                src="https://dummyimage.com/200x200/dee2e6/6c757d.jpg"
            />
        </div>
        <div class="col-md-6 mt-1">
            <h4 class="mb-0 fw-bold">Quant olap shirts</h4>
            <p class="fs-6">by <a href="/">Jules Verne</a></p>
            <p class="text-justify mb-0" style="min-height: 155px">
                There are many variations of passages of Lorem Ipsum available,
                but the majority have suffered alteration in some form, by
                injected humour, or randomised words which don't look even
                slightly believable.<br /><br />
            </p>

            <div class="mt-1 mb-1 spec-1">
                <ul class="list-inline list-inline-dotted mb-0">
                    <li class="list-inline-item">Formats:</li>
                    <li class="list-inline-item">
                        <a href="#" class="text-muted">Kindle</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-muted">Paperback</a>
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
                <h4 class="mt-3">13.99 €</h4>
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
                <button class="btn btn-primary btn-sm" type="button">
                    Details</button
                ><button
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
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'BooksListItem',
})
</script>

<style lang="scss" module>
.component :global {
    .product-image {
        width: 100%;
    }

    .spec-1 {
        color: #938787;
        font-size: 15px;
    }

    h5 {
        font-weight: 400;
    }

    .para {
        font-size: 16px;
    }
}
</style>

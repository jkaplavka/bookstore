<template>
    <nav
        :class="[
            $style.component,
            'navbar',
            'navbar-expand-lg',
            'navbar-dark',
            'bg-dark',
        ]"
    >
        <div class="container-fluid">
            <a class="navbar-brand fs-2" href="/">
                <i class="bi bi-bookmark"></i> Bookstore
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarToggler"
                aria-controls="navbarToggler"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div
                class="
                    collapse
                    navbar-collapse
                    d-lg-flex
                    justify-content-lg-end
                "
                id="navbarToggler"
            >
                <ul class="navbar-nav d-flex">
                    <li class="nav-item pt-2">
                        <a class="nav-link" href="#">Admin</a>
                    </li>
                    <li class="nav-item">
                        <cart-widget />
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import CartWidget from '@/components/cart/widget.vue'

export default defineComponent({
    name: 'NavBar',
    components: { CartWidget },
})
</script>

<style lang="scss" module>
.component :global {
    border-bottom: 1px solid black;
}
</style>

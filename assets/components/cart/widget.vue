<template>
    <a class="nav-link" href="/">
        <button class="btn btn-outline-light" type="submit">
            <i class="bi-cart-fill me-1"></i>
            Cart
            <span class="badge bg-light text-dark ms-1 rounded-pill">0</span>
        </button>
    </a>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'CartWidget',
})
</script>

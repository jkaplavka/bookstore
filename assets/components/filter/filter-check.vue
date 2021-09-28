<template>
    <div class="dropdown">
        <button
            class="btn btn-sm btn-outline-secondary dropdown-toggle"
            type="button"
            id="dropdownMenuButton1"
            data-bs-toggle="dropdown"
            data-bs-auto-close="outside"
            aria-expanded="false"
        >
            <i class="bi-funnel me-1"></i>
        </button>
        <div class="dropdown-menu">
            <form id="myform" class="px-2 py-2">
                <div class="mb-3">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="dropdownCheck"
                        />
                        <label
                            class="form-check-label fw-normal"
                            for="dropdownCheck"
                        >
                            Category 1
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="dropdownCheck2"
                        />
                        <label
                            class="form-check-label fw-normal"
                            for="dropdownCheck2"
                        >
                            Category 2
                        </label>
                    </div>
                </div>
            </form>
            <div class="dropdown-divider"></div>

            <div class="d-grid m-2">
                <button
                    type="submit"
                    form="myform"
                    class="btn btn-sm btn-outline-secondary"
                >
                    Filter
                </button>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'

export default defineComponent({
    name: 'FilterComponent',
})
</script>

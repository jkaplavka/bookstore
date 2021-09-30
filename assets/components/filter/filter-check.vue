<template>
    <div class="dropdown">
        <button
            class="btn btn-sm btn-outline-secondary dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            data-bs-auto-close="inside"
            aria-expanded="false"
        >
            <i
                :class="[
                    'me-1',
                    checked.length === 0 ? 'bi-funnel' : 'bi-funnel-fill',
                ]"
            ></i>
        </button>
        <div class="dropdown-menu">
            <form :id="id" class="px-2 py-2" @submit.prevent="onSubmit">
                <div class="mb-3">
                    <div
                        v-for="(value, index) in values"
                        :key="index"
                        class="form-check"
                    >
                        <input
                            type="checkbox"
                            class="form-check-input"
                            :id="value.value"
                            :value="value.value"
                            v-model="checked"
                        />
                        <label
                            class="form-check-label fw-normal"
                            :for="value.value"
                        >
                            {{ value.label }}
                        </label>
                    </div>
                </div>
            </form>
            <div class="dropdown-divider"></div>

            <div class="d-grid m-2">
                <button
                    type="submit"
                    :form="id"
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
import { v4 as uuidv4 } from 'uuid'

export default defineComponent({
    name: 'FilterComponent',
    data: () => ({
        id: uuidv4(),
        checked: [] as string[],
    }),
    props: {
        property: {
            type: String,
            required: true,
        },
        values: {
            type: Array,
            required: true,
        },
        selected: {
            type: Array as PropType<Array<string>>,
            defautl: [],
        },
    },
    created() {
        this.checked = this.selected!
    },
    methods: {
        onSubmit() {
            this.$emit('filter-changed', {
                values: this.checked,
                property: this.property,
            })
        },
    },
})
</script>

<template>
    <div class="input-group mb-3">
        <multiselect
            v-model="value"
            mode="tags"
            :class="{ 'multiselect-blue': true, 'is-invalid': !isValid }"
            :searchable="true"
            :createTag="true"
            :options="options"
        />
        <span v-show="!isValid" class="invalid-feedback">
            {{ errorMessage }}
        </span>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import Multiselect from '@vueform/multiselect'

interface Option {
    label: string
    value: string
}

export default defineComponent({
    name: 'InputSelectMulti',
    components: {
        Multiselect,
    },
    data: () => ({
        value: [] as string[],
    }),
    props: {
        id: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            default: '',
        },
        errorMessage: {
            type: String,
            default: '',
        },
        options: {
            type: Array as PropType<Array<Option>>,
            required: true,
        },
        modelValue: {
            type: Array as PropType<Array<string>>,
            default: [],
        },
    },
    computed: {
        isValid(): boolean {
            return !this.errorMessage
        },
    },
    watch: {
        value() {
            this.$emit('update:modelValue', this.value)
        },
    },
    created() {
        this.value = this.modelValue
    },
})
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
<style lang="scss">
.multiselect-blue {
    --ms-tag-bg: #dbeafe;
    --ms-tag-color: #2563eb;

    &.is-invalid {
        --ms-border-color: #dc3545;
    }
}
</style>

<template>
    <div class="input-group mb-3">
        <select
            :class="{
                'form-select': true,
                'is-invalid': !isValid,
            }"
            :id="id"
            :name="id"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        >
            <option v-if="label" selected disabled value="">{{ label }}</option>
            <option
                v-for="(option, index) in options"
                :key="index"
                :value="option.value"
            >
                {{ option.label }}
            </option>
        </select>
        <span v-show="!isValid" class="invalid-feedback">
            {{ errorMessage }}
        </span>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'

interface Option {
    label: string
    value: string
}

export default defineComponent({
    name: 'InputSelect',
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
            type: String,
            default: '',
        },
    },
    computed: {
        isValid(): boolean {
            return !this.errorMessage
        },
    },
})
</script>

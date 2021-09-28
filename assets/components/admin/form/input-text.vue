<template>
    <div class="input-group mb-3">
        <input
            :id="id"
            :name="id"
            :value="modelValue"
            :placeholder="label"
            :type="type"
            :min="min"
            :max="max"
            :step="step"
            :class="{
                'form-control': true,
                'is-invalid': !isValid,
            }"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <span v-if="textAfter" class="input-group-text">{{ textAfter }}</span>
        <span v-show="!isValid" class="invalid-feedback">
            {{ errorMessage }}
        </span>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'InputText',
    props: {
        id: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            required: true,
        },
        errorMessage: {
            type: String,
            default: '',
        },
        modelValue: {
            type: String,
            default: '',
        },
        type: {
            type: String,
            default: 'text',
        },
        min: {
            type: String,
            default: '',
        },
        max: {
            type: String,
            default: '',
        },
        step: {
            type: String,
            default: '',
        },
        textAfter: {
            type: String,
            default: null,
        },
    },
    computed: {
        isValid(): boolean {
            return !this.errorMessage
        },
    },
})
</script>

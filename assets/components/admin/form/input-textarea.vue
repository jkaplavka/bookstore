<template>
    <div class="form-group mb-3">
        <div class="form-floating">
            <textarea
                :id="id"
                :name="id"
                :value="modelValue"
                :placeholder="label"
                type="text"
                :class="{
                    'form-control': true,
                    'is-invalid': !isValid,
                }"
                @input="$emit('update:modelValue', $event.target.value)"
                style="min-height: 100px; max-height: 300px"
            ></textarea>
            <label for="id">{{ label }}</label>
        </div>
        <span v-show="!isValid" class="invalid-feedback">
            {{ errorMessage }}
        </span>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'InputTextArea',
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
    },
    computed: {
        isValid(): boolean {
            return !this.errorMessage
        },
    },
})
</script>

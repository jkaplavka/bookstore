<template>
    <div>
        <h1 class="mt-4">{{ title }}</h1>
        <ol class="breadcrumb mb-4">
            <li
                v-for="(item, index) in path"
                :key="index"
                :class="{
                    'breadcrumb-item': true,
                    actice: item.actice,
                }"
            >
                {{ item.label }}
            </li>
        </ol>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import BreadcrumbsPath from './breadcrumbsPath'

export default defineComponent({
    name: 'Breadcrumbs',
    props: {
        title: {
            type: String,
            default: null,
        },
        path: {
            type: Array as PropType<Array<BreadcrumbsPath>>,
            default: null,
        },
    },
})
</script>

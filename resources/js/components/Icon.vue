<script setup lang="ts">
interface Props {
    name: string
    class?: string
    size?: number | string
}

const props = withDefaults(defineProps<Props>(), {
    size: 24,
})

const sizeValue = typeof props.size === 'number' ? `${props.size}px` : props.size
</script>

<template>
    <span
        :class="props.class"
        :style="{
            width: sizeValue,
            height: sizeValue,
            display: 'inline-block',
            verticalAlign: 'middle'
        }"
        :data-icon="name"
    >
        <!-- This is a placeholder icon component -->
        <!-- You can integrate with icon libraries like lucide-vue, heroicons, etc. -->
        <svg
            :width="sizeValue"
            :height="sizeValue"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <!-- Default icon - you can replace this with dynamic icon rendering -->
            <circle cx="12" cy="12" r="10" />
        </svg>
    </span>
</template>

<script setup lang="ts">
import { cn } from '@admin/lib/utils'
import { Link } from '@inertiajs/vue3'

interface Props {
  class?: string
  href?: string
  active?: boolean
  disabled?: boolean
}

const props = defineProps<Props>()
</script>

<template>
  <li>
    <component
      :is="props.href && !props.disabled ? Link : 'span'"
      :href="props.href"
      :class="cn(
        'inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors',
        'focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring',
        'h-9 w-9',
        props.active
          ? 'bg-primary text-primary-foreground hover:bg-primary/90'
          : 'hover:bg-accent hover:text-accent-foreground',
        props.disabled && 'pointer-events-none opacity-50',
        props.class
      )"
    >
      <slot />
    </component>
  </li>
</template>

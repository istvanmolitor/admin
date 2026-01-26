<script setup lang="ts">
import { cn } from '@admin/lib/utils'

interface Props {
  class?: string
}

defineProps<Props>()
</script>

<template>
  <ul :class="cn('flex flex-row items-center gap-1', props.class)">
    <slot />
  </ul>
</template>

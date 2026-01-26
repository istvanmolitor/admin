<script setup lang="ts">
import { cn } from '@admin/lib/utils'

interface Props {
  class?: string
}

defineProps<Props>()
</script>

<template>
  <span :class="cn('flex h-9 w-9 items-center justify-center', props.class)">
    <slot>
      <span>...</span>
    </slot>
  </span>
</template>

<script setup lang="ts">
import { cn } from '@admin/lib/utils'

interface Props {
  class?: string
}

defineProps<Props>()
</script>

<template>
  <div class="w-full overflow-auto">
    <table :class="cn('w-full caption-bottom text-sm', props.class)">
      <slot />
    </table>
  </div>
</template>

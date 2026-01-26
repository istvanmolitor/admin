<script setup lang="ts">
import { cn } from '@admin/lib/utils'

interface Props {
  currentPage: number
  lastPage: number
  class?: string
}

const props = defineProps<Props>()
</script>

<template>
  <div :class="cn('text-sm text-muted-foreground', props.class)">
    Page {{ currentPage }} of {{ lastPage }}
  </div>
</template>

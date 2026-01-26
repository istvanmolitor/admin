<script setup lang="ts">
import { PaginationRoot, type PaginationRootEmits, type PaginationRootProps } from 'reka-ui'
import { cn } from '@admin/lib/utils'

interface Props extends PaginationRootProps {
  class?: string
}

const props = defineProps<Props>()
const emit = defineEmits<PaginationRootEmits>()
</script>

<template>
  <PaginationRoot
    v-bind="props"
    :class="cn('mx-auto flex w-full justify-center', props.class)"
    @update:page="emit('update:page', $event)"
  >
    <slot />
  </PaginationRoot>
</template>

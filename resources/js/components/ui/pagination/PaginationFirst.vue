<script setup lang="ts">
import { PaginationFirst, type PaginationFirstProps } from 'reka-ui'
import { Button } from '@admin/components/ui/button'
import { cn } from '@admin/lib/utils'
import { ChevronFirst } from 'lucide-vue-next'

interface Props extends PaginationFirstProps {
  class?: string
}

const props = defineProps<Props>()
</script>

<template>
  <PaginationFirst v-slot="{ disabled }" as-child>
    <Button
      :disabled="disabled"
      size="icon"
      variant="outline"
      :class="cn('h-10 w-10', props.class)"
    >
      <ChevronFirst class="h-4 w-4" />
      <span class="sr-only">First page</span>
    </Button>
  </PaginationFirst>
</template>

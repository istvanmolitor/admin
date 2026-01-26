<script setup lang="ts">
import { PaginationNext, type PaginationNextProps } from 'reka-ui'
import { Button } from '@admin/components/ui/button'
import { cn } from '@admin/lib/utils'
import { ChevronRight } from 'lucide-vue-next'

interface Props extends PaginationNextProps {
  class?: string
}

const props = defineProps<Props>()
</script>

<template>
  <PaginationNext v-slot="{ disabled }" as-child>
    <Button
      :disabled="disabled"
      size="icon"
      variant="outline"
      :class="cn('h-10 w-10', props.class)"
    >
      <ChevronRight class="h-4 w-4" />
      <span class="sr-only">Next page</span>
    </Button>
  </PaginationNext>
</template>

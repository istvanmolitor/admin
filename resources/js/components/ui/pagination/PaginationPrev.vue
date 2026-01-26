<script setup lang="ts">
import { PaginationPrev, type PaginationPrevProps } from 'reka-ui'
import { Button } from '@admin/components/ui/button'
import { cn } from '@admin/lib/utils'
import { ChevronLeft } from 'lucide-vue-next'

interface Props extends PaginationPrevProps {
  class?: string
}

const props = defineProps<Props>()
</script>

<template>
  <PaginationPrev v-slot="{ disabled }" as-child>
    <Button
      :disabled="disabled"
      size="icon"
      variant="outline"
      :class="cn('h-10 w-10', props.class)"
    >
      <ChevronLeft class="h-4 w-4" />
      <span class="sr-only">Previous page</span>
    </Button>
  </PaginationPrev>
</template>

<script setup lang="ts">
import { PaginationLast, type PaginationLastProps } from 'reka-ui'
import { Button } from '@admin/components/ui/button'
import { cn } from '@admin/lib/utils'
import { ChevronLast } from 'lucide-vue-next'

interface Props extends PaginationLastProps {
  class?: string
}

const props = defineProps<Props>()
</script>

<template>
  <PaginationLast v-slot="{ disabled }" as-child>
    <Button
      :disabled="disabled"
      size="icon"
      variant="outline"
      :class="cn('h-10 w-10', props.class)"
    >
      <ChevronLast class="h-4 w-4" />
      <span class="sr-only">Last page</span>
    </Button>
  </PaginationLast>
</template>

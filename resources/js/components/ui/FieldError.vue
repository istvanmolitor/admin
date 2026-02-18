<script setup lang="ts">
import { computed } from 'vue'

type Props = {
  errors?: string | string[]
}

const props = defineProps<Props>()

const errorMessages = computed(() => {
  if (!props.errors) return []
  return Array.isArray(props.errors) ? props.errors : [props.errors]
})
</script>

<template>
  <div v-if="errorMessages.length > 0" class="text-sm text-red-600 dark:text-red-500 space-y-1">
    <p v-for="(error, index) in errorMessages" :key="index">
      {{ error }}
    </p>
  </div>
</template>



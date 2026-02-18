<script setup lang="ts">
import Button from './Button.vue'

type Props = {
  isSaving?: boolean
  saveLabel?: string
  cancelLabel?: string
}

withDefaults(defineProps<Props>(), {
  isSaving: false,
  saveLabel: 'Mentés',
  cancelLabel: 'Mégse'
})

const emit = defineEmits<{
  save: []
  cancel: []
}>()
</script>

<template>
  <div class="flex items-center gap-2">
    <Button
      type="button"
      @click="emit('save')"
      :disabled="isSaving"
    >
      {{ isSaving ? 'Mentés...' : saveLabel }}
    </Button>
    <Button
      type="button"
      variant="outline"
      @click="emit('cancel')"
      :disabled="isSaving"
    >
      {{ cancelLabel }}
    </Button>
  </div>
</template>


<script setup lang="ts">
import { ref, computed } from 'vue'
import Label from './label/Label.vue'
import Input from './input/Input.vue'
import Checkbox from './checkbox/Checkbox.vue'
import Button from './button/Button.vue'
import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from './collapsible'

type Props = {
  items: any[]
  label?: string
  labelField?: string
  placeholder?: string
  searchPlaceholder?: string
  emptyMessage?: string
  modelValue?: number[]
}

const props = withDefaults(defineProps<Props>(), {
  labelField: 'name',
  placeholder: 'Válassz elemeket...',
  searchPlaceholder: 'Keresés...',
  emptyMessage: 'Nincs elérhető elem.',
  modelValue: () => []
})

const emit = defineEmits<{
  'update:modelValue': [value: number[]]
}>()

const isOpen = ref(false)
const searchQuery = ref('')

const filteredItems = computed(() => {
  if (!searchQuery.value) return props.items

  const query = searchQuery.value.toLowerCase()
  return props.items.filter(item =>
    item[props.labelField].toLowerCase().includes(query)
  )
})

const selectedItems = computed(() => {
  return props.items.filter(item => props.modelValue.includes(item.id))
})

const toggleItem = (itemId: number) => {
  const index = props.modelValue.indexOf(itemId)
  const newValue = [...props.modelValue]

  if (index > -1) {
    newValue.splice(index, 1)
  } else {
    newValue.push(itemId)
  }

  emit('update:modelValue', newValue)
}

const isSelected = (itemId: number) => {
  return props.modelValue.includes(itemId)
}

const removeItem = (itemId: number) => {
  const newValue = props.modelValue.filter(id => id !== itemId)
  emit('update:modelValue', newValue)
}
</script>

<template>
  <div class="space-y-2">
    <Label v-if="label">{{ label }}</Label>

    <!-- Selected items display -->
    <div v-if="selectedItems.length > 0" class="flex flex-wrap gap-2 mb-2">
      <div
        v-for="item in selectedItems"
        :key="item.id"
        class="inline-flex items-center gap-1 px-2 py-1 text-sm bg-primary/10 text-primary rounded"
      >
        <span>{{ item[labelField] }}</span>
        <button
          type="button"
          @click="removeItem(item.id)"
          class="hover:text-primary/80"
        >
          ×
        </button>
      </div>
    </div>

    <!-- Collapsible selector -->
    <Collapsible v-model:open="isOpen" class="w-full">
      <CollapsibleTrigger as-child>
        <Button
          type="button"
          variant="outline"
          class="w-full justify-between"
        >
          <span>{{ placeholder }}</span>
          <span class="ml-2">{{ isOpen ? '▲' : '▼' }}</span>
        </Button>
      </CollapsibleTrigger>

      <CollapsibleContent class="border rounded-md mt-2 p-2 space-y-2">
        <!-- Search input -->
        <Input
          v-model="searchQuery"
          :placeholder="searchPlaceholder"
          class="w-full"
        />

        <!-- Items list -->
        <div class="max-h-64 overflow-y-auto space-y-1">
          <div
            v-if="filteredItems.length === 0"
            class="text-sm text-muted-foreground text-center py-4"
          >
            {{ emptyMessage }}
          </div>

          <label
            v-for="item in filteredItems"
            :key="item.id"
            class="flex items-center space-x-2 p-2 hover:bg-accent rounded cursor-pointer"
          >
            <Checkbox
              :checked="isSelected(item.id)"
              @update:checked="() => toggleItem(item.id)"
            />
            <span class="text-sm">{{ item[labelField] }}</span>
          </label>
        </div>
      </CollapsibleContent>
    </Collapsible>
  </div>
</template>


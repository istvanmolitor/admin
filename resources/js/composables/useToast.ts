import { ref, computed } from 'vue'

/**
 * Composable for managing toast notifications
 */
export function useToast() {
  const toasts = ref<Array<{
    id: string
    title?: string
    description?: string
    variant?: 'default' | 'destructive' | 'success'
  }>>([])

  const toast = (options: {
    title?: string
    description?: string
    variant?: 'default' | 'destructive' | 'success'
  }) => {
    const id = Math.random().toString(36).substring(7)
    toasts.value.push({ id, ...options })

    setTimeout(() => {
      dismiss(id)
    }, 5000)
  }

  const dismiss = (id: string) => {
    toasts.value = toasts.value.filter(t => t.id !== id)
  }

  return {
    toasts: computed(() => toasts.value),
    toast,
    dismiss,
  }
}

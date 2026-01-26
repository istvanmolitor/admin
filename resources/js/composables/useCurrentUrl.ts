import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

/**
 * Composable to check if a URL matches the current page URL
 */
export function useCurrentUrl() {
    const page = usePage()

    /**
     * Get the current URL path
     */
    const currentUrl = computed(() => {
        return page.url || ''
    })

    /**
     * Check if the given URL matches the current URL
     */
    const isCurrentUrl = (url: string): boolean => {
        const current = currentUrl.value

        // Exact match
        if (current === url) {
            return true
        }

        // Check if current URL starts with the given URL (for nested routes)
        // But exclude root path to avoid matching everything
        if (url !== '/' && current.startsWith(url)) {
            return true
        }

        return false
    }

    return {
        currentUrl,
        isCurrentUrl,
    }
}


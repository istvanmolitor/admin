import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

/**
 * Composable to check if a URL is currently active
 * Useful for navigation menu highlighting
 */
export function useActiveUrl() {
    const page = usePage()

    /**
     * Get the current URL path
     */
    const currentUrl = computed(() => {
        if (typeof window !== 'undefined') {
            return window.location.pathname
        }
        return page.url || ''
    })

    /**
     * Check if the given URL matches the current URL
     */
    const isActive = (url: string, exact = false): boolean => {
        const current = currentUrl.value

        if (exact) {
            return current === url
        }

        // Check if current URL starts with the given URL
        return current.startsWith(url)
    }

    /**
     * Check if any of the given URLs match the current URL
     */
    const isActiveAny = (urls: string[], exact = false): boolean => {
        return urls.some(url => isActive(url, exact))
    }

    /**
     * Get CSS class based on active state
     */
    const activeClass = (url: string, activeClasses: string, inactiveClasses = '', exact = false): string => {
        return isActive(url, exact) ? activeClasses : inactiveClasses
    }

    return {
        currentUrl,
        isActive,
        urlIsActive: isActive, // Alias for compatibility
        isActiveAny,
        activeClass,
    }
}

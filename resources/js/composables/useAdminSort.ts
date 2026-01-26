import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

interface SortableProps {
    filters?: {
        sort?: string
        order?: 'asc' | 'desc'
    }
}

export function useAdminSort(routeName: string, props: SortableProps) {
    const currentSort = computed(() => props.filters?.sort || '')
    const currentOrder = computed(() => props.filters?.order || 'asc')

    /**
     * Sort by the given field
     */
    const sortBy = (field: string) => {
        let order: 'asc' | 'desc' = 'asc'

        // If already sorting by this field, toggle the order
        if (currentSort.value === field) {
            order = currentOrder.value === 'asc' ? 'desc' : 'asc'
        }

        router.get(
            window.location.pathname,
            {
                ...props.filters,
                sort: field,
                order: order,
            },
            {
                preserveState: true,
                preserveScroll: true,
                only: ['data', 'filters'],
            }
        )
    }

    /**
     * Get the sort icon for the given field
     */
    const getSortIcon = (field: string) => {
        if (currentSort.value !== field) {
            return '↕️' // or return a neutral icon
        }
        return currentOrder.value === 'asc' ? '↑' : '↓'
    }

    /**
     * Check if the given field is currently being sorted
     */
    const isSorted = (field: string) => {
        return currentSort.value === field
    }

    /**
     * Get the current sort direction for the given field
     */
    const getSortDirection = (field: string): 'asc' | 'desc' | null => {
        if (currentSort.value !== field) {
            return null
        }
        return currentOrder.value
    }

    return {
        sortBy,
        getSortIcon,
        isSorted,
        getSortDirection,
        currentSort,
        currentOrder,
    }
}

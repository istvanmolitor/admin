/**
 * Composable to map icon names to icon components
 * This allows for dynamic icon rendering based on string names
 */
export function useIconMap() {
    /**
     * Get an icon component by name
     * Returns a simple string icon for now - can be extended to return actual icon components
     */
    const getIcon = (iconName?: string) => {
        if (!iconName) return null

        // This is a placeholder - you can integrate with icon libraries like lucide-vue-next
        // For now, just return the icon name
        return iconName
    }

    return {
        getIcon,
    }
}

import type { LucideIcon } from 'lucide-vue-next';
import { Component } from 'vue';

/**
 * Composable for mapping icon names/components
 */
export function useIconMap() {
    /**
     * Get icon component from icon name or component
     */
    const getIcon = (icon?: LucideIcon | string): Component | undefined => {
        if (!icon) {
            return undefined;
        }

        // If it's already a component, return it
        if (typeof icon !== 'string') {
            return icon as Component;
        }

        // Otherwise, it's a string icon name, return undefined
        // (could be extended to map string names to components if needed)
        return undefined;
    };

    return {
        getIcon,
    };
}

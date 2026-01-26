import { ref } from 'vue'

/**
 * Composable to manage menu state (open/collapsed)
 * Useful for sidebar navigation
 */
export function useMenuState() {
    const openMenus = ref<Set<string>>(new Set())

    /**
     * Check if a menu is open
     */
    const isMenuOpen = (menuId: string, defaultOpen?: boolean): boolean => {
        // If menu state hasn't been set yet and defaultOpen is provided, use it
        if (!openMenus.value.has(menuId) && defaultOpen !== undefined) {
            if (defaultOpen) {
                openMenus.value.add(menuId)
            }
            return defaultOpen
        }
        return openMenus.value.has(menuId)
    }

    /**
     * Set menu open state
     */
    const setMenuOpen = (menuId: string, isOpen: boolean) => {
        if (isOpen) {
            openMenus.value.add(menuId)
        } else {
            openMenus.value.delete(menuId)
        }
    }

    /**
     * Toggle menu open state
     */
    const toggleMenu = (menuId: string) => {
        setMenuOpen(menuId, !isMenuOpen(menuId))
    }

    /**
     * Close all menus
     */
    const closeAllMenus = () => {
        openMenus.value.clear()
    }

    return {
        isMenuOpen,
        setMenuOpen,
        toggleMenu,
        closeAllMenus,
    }
}

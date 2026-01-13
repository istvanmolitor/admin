import { ref, watch } from 'vue';

const STORAGE_KEY = 'admin-menu-state';

export function useMenuState() {
    // Load initial state from localStorage
    const loadMenuState = (): Record<string, boolean> => {
        try {
            const stored = localStorage.getItem(STORAGE_KEY);
            return stored ? JSON.parse(stored) : {};
        } catch {
            return {};
        }
    };

    const menuState = ref<Record<string, boolean>>(loadMenuState());

    // Save state to localStorage whenever it changes
    watch(
        menuState,
        (newState) => {
            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(newState));
            } catch (error) {
                console.error('Failed to save menu state:', error);
            }
        },
        { deep: true }
    );

    const isMenuOpen = (itemTitle: string, defaultOpen: boolean = false): boolean => {
        // If state exists in storage, use it; otherwise use defaultOpen
        return menuState.value[itemTitle] !== undefined
            ? menuState.value[itemTitle]
            : defaultOpen;
    };

    const setMenuOpen = (itemTitle: string, isOpen: boolean) => {
        menuState.value[itemTitle] = isOpen;
    };

    return {
        isMenuOpen,
        setMenuOpen,
    };
}


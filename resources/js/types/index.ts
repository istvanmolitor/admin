/**
 * Navigation item type
 */
export interface NavItem {
    title: string
    url?: string
    icon?: string
    isActive?: boolean
    items?: NavItem[]
    badge?: string | number
    disabled?: boolean
}

/**
 * Menu item with children
 */
export interface MenuItem extends NavItem {
    children?: MenuItem[]
}

/**
 * Route helper - re-exports all route definitions
 * This allows admin package components to access route helpers
 */

// Re-export wayfinder types and utilities
export type { RouteDefinition, RouteFormDefinition, RouteQueryOptions, QueryParams } from '@/wayfinder'
export { queryParams, setUrlDefaults, addUrlDefault, applyUrlDefaults } from '@/wayfinder'

// Re-export all routes
export * from '@/routes'
export * as admin from '@/routes/admin'
export * as user from '@/routes/user'
export * as cms from '@/routes/cms'
export * as language from '@/routes/language'

// Helper function to access route by name
export const route = (name: string, params?: Record<string, any>) => {
    // This is a placeholder that would need to be implemented based on your routing needs
    // For now, it just returns the name as a path
    console.warn('route() helper is not fully implemented, using fallback')
    return `/${name}`
}

import { type ClassValue, clsx } from "clsx"
import { twMerge } from "tailwind-merge"

/**
 * Utility function for merging Tailwind CSS classes with clsx
 * This is the standard shadcn-vue utility function
 */
export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}

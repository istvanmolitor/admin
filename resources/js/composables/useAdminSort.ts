import { router } from '@inertiajs/vue3';
import { route } from '@/lib/route';

export function useAdminSort(routeName: string, props: any) {
    const sortBy = (column: string) => {
        let direction: 'asc' | 'desc' = 'asc';
        if (props.filters.sort === column && props.filters.direction === 'asc') {
            direction = 'desc';
        }
        router.get(route(routeName), {
            search: props.filters.search,
            sort: column,
            direction: direction,
        }, {
            preserveState: true,
            replace: true,
        });
    };

    const getSortIcon = (column: string) => {
        if (props.filters.sort !== column) return 'chevrons-up-down';
        return props.filters.direction === 'asc' ? 'chevron-up' : 'chevron-down';
    };

    return {
        sortBy,
        getSortIcon,
    };
}

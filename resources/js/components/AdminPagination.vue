<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import {
    Pagination,
    PaginationEllipsis,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
    PaginationInfo,
} from '@/components/ui/pagination';
import { Button } from '@/components/ui/button';
import { route } from '@/lib/route';

interface Props {
    routeName: string;
    data: {
        current_page: number;
        last_page: number;
        total: number;
        per_page: number;
    };
    filters?: Record<string, any>;
}

const props = defineProps<Props>();

const handlePageChange = (page: number) => {
    router.get(route(props.routeName), {
        page,
        ...props.filters,
    });
};
</script>

<template>
    <div class="flex items-center justify-between px-2">
        <PaginationInfo :current-page="data.current_page" :last-page="data.last_page" />
        <Pagination
            v-if="data.last_page > 1"
            :total="data.total"
            :sibling-count="1"
            :show-edges="true"
            :default-page="data.current_page"
            :items-per-page="data.per_page"
            @update:page="handlePageChange"
        >
            <PaginationList v-slot="{ items }" class="flex items-center gap-1">
                <PaginationFirst />
                <PaginationPrev />

                <template v-for="(item, index) in items">
                    <PaginationListItem v-if="item.type === 'page'" :key="index" :value="item.value" as-child>
                        <Button class="w-10 h-10 p-0" :variant="item.value === data.current_page ? 'default' : 'outline'">
                            {{ item.value }}
                        </Button>
                    </PaginationListItem>
                    <PaginationEllipsis v-else :key="item.type" :index="index" />
                </template>

                <PaginationNext />
                <PaginationLast />
            </PaginationList>
        </Pagination>
    </div>
</template>

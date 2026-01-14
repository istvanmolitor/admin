<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { route } from '@/lib/route';

interface Props {
    routeName: string;
    data: {
        current_page: number;
        last_page: number;
    };
    filters?: Record<string, any>;
}

const props = defineProps<Props>();

const goToPage = (page: number) => {
    router.get(route(props.routeName), {
        page,
        ...props.filters,
    });
};
</script>

<template>
    <div v-if="data.last_page > 1" class="flex justify-center gap-2">
        <Button
            v-for="page in data.last_page"
            :key="page"
            :variant="page === data.current_page ? 'default' : 'outline'"
            size="sm"
            @click="goToPage(page)"
        >
            {{ page }}
        </Button>
    </div>
</template>

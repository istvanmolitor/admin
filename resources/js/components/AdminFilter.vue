<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { trans } from 'laravel-vue-i18n';

interface Props {
    routeName: string;
    filters: {
        search?: string;
        sort?: string;
        direction?: 'asc' | 'desc';
    };
    placeholder?: string;
}

const props = defineProps<Props>();

const search = ref(props.filters.search || '');

const handleSearch = () => {
    router.get(route(props.routeName), {
        search: search.value,
        sort: props.filters.sort,
        direction: props.filters.direction,
    }, {
        preserveState: true,
        replace: true,
    });
};

const clearSearch = () => {
    search.value = '';
    handleSearch();
};
</script>

<template>
    <div class="flex gap-2">
        <div class="relative w-full max-w-sm">
            <Input
                v-model="search"
                type="text"
                :placeholder="placeholder || trans('admin::common.search')"
                class="pr-10"
                @keyup.enter="handleSearch"
            />
            <button
                v-if="search"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                @click="clearSearch"
            >
                ✕
            </button>
        </div>
        <Button @click="handleSearch">{{ trans('admin::common.search_button') || trans('user::user.actions.search') }}</Button>
    </div>
</template>

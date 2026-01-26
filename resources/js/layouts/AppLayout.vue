<script setup lang="ts">
import AppLayout from '@admin/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItem } from '@admin/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>
</template>

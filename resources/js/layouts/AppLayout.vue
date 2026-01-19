<script setup lang="ts">
import AppLayout from '@admin/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@admin/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>
</template>

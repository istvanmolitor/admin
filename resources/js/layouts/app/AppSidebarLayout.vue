<script setup lang="ts">
import AppContent from '@admin/components/AppContent.vue';
import AppShell from '@admin/components/AppShell.vue';
import AppSidebar from '@admin/components/AppSidebar.vue';
import AppSidebarHeader from '@admin/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType } from '@admin/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell variant="sidebar">
        <AppSidebar />
        <AppContent variant="sidebar" class="overflow-x-hidden">
            <AppSidebarHeader :breadcrumbs="breadcrumbs" />
            <slot />
        </AppContent>
    </AppShell>
</template>

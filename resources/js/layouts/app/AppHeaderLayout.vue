<script setup lang="ts">
import AppContent from '@admin/components/AppContent.vue';
import AppHeader from '@admin/components/AppHeader.vue';
import AppShell from '@admin/components/AppShell.vue';
import type { BreadcrumbItem } from '@admin/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell class="flex-col">
        <AppHeader :breadcrumbs="breadcrumbs" />
        <AppContent>
            <slot />
        </AppContent>
    </AppShell>
</template>

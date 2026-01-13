<script lang="ts" setup>
import { Toaster as Sonner } from 'vue-sonner';
import { CircleCheckIcon, InfoIcon, OctagonXIcon, TriangleAlertIcon, XIcon } from 'lucide-vue-next';

interface Props {
    position?: 'top-center' | 'top-right' | 'bottom-center' | 'bottom-right';
    richColors?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    position: 'top-center',
    richColors: true,
});
</script>

<template>
    <Sonner
        :position="props.position"
        :rich-colors="props.richColors"
        class="toaster group"
        :style="{
            '--normal-bg': 'var(--popover)',
            '--normal-text': 'var(--popover-foreground)',
            '--normal-border': 'var(--border)',
            '--border-radius': 'var(--radius)',
        }"
        :close-button="true"
    >
        <template #success-icon>
            <CircleCheckIcon class="size-5" />
        </template>
        <template #info-icon>
            <InfoIcon class="size-5" />
        </template>
        <template #warning-icon>
            <TriangleAlertIcon class="size-5" />
        </template>
        <template #error-icon>
            <OctagonXIcon class="size-5" />
        </template>
        <template #close-icon>
            <XIcon class="size-4" />
        </template>
    </Sonner>
</template>


<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';

interface Props {
    url: string;
    title?: string;
    message?: string;
    confirmText?: string;
    cancelText?: string;
    buttonText?: string;
    variant?: 'destructive' | 'outline' | 'ghost' | 'secondary' | 'default';
    size?: 'default' | 'sm' | 'lg' | 'icon';
}

const props = withDefaults(defineProps<Props>(), {
    title: () => trans('admin::delete.title'),
    message: () => trans('admin::delete.message'),
    confirmText: () => trans('admin::delete.confirm'),
    cancelText: () => trans('admin::delete.cancel'),
    buttonText: () => trans('admin::delete.confirm'),
    variant: 'destructive',
    size: 'sm',
});

const isOpen = ref(false);

const deleteItem = () => {
    router.delete(props.url, {
        onSuccess: () => {
            isOpen.value = false;
        },
    });
};
</script>

<template>
    <Dialog v-model:open="isOpen">
        <DialogTrigger as-child>
            <Button :variant="variant" :size="size">
                <slot>
                    {{ buttonText }}
                </slot>
            </Button>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>{{ title }}</DialogTitle>
                <DialogDescription>
                    {{ message }}
                </DialogDescription>
            </DialogHeader>
            <DialogFooter>
                <Button variant="outline" @click="isOpen = false">
                    {{ cancelText }}
                </Button>
                <Button variant="destructive" @click="deleteItem">
                    {{ confirmText }}
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

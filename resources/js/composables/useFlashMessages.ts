import { router, usePage } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';
import { onUnmounted } from 'vue';

interface FlashMessages {
    success?: string;
    error?: string;
    info?: string;
    warning?: string;
}

export function useFlashMessages() {
    const page = usePage();

    const checkFlashMessages = () => {
        const flash = page.props.flash as FlashMessages | undefined;

        if (!flash) return;

        if (flash.success) {
            toast.success(flash.success);
        }

        if (flash.error) {
            toast.error(flash.error);
        }

        if (flash.info) {
            toast.info(flash.info);
        }

        if (flash.warning) {
            toast.warning(flash.warning);
        }
    };

    // Check after each Inertia navigation
    const removeFinishListener = router.on('finish', () => {
        checkFlashMessages();
    });

    // Clean up event listener on unmount
    onUnmounted(() => {
        removeFinishListener();
    });
}


<script setup lang="ts">
import { ref } from 'vue';
import { useI18n } from '@/composables/useI18n';
import { getActiveLanguage } from 'laravel-vue-i18n';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

const { t, switchLanguage } = useI18n();
const currentLocale = ref(getActiveLanguage());

const languages = [
    { code: 'en', name: 'English' },
    { code: 'de', name: 'Deutsch' },
    { code: 'hu', name: 'Magyar' },
];

const changeLanguage = async (locale: string) => {
    await switchLanguage(locale);
    currentLocale.value = locale;
};
</script>

<template>
    <Card class="w-full max-w-md">
        <CardHeader>
            <CardTitle>{{ t('Welcome') }}</CardTitle>
            <CardDescription>
                {{ t('Dashboard') }}
            </CardDescription>
        </CardHeader>
        <CardContent class="space-y-4">
            <div class="space-y-2">
                <p class="text-sm font-medium">{{ t('Profile') }}</p>
                <p class="text-sm text-muted-foreground">
                    {{ t('Email') }}: user@example.com
                </p>
            </div>

            <div class="space-y-2">
                <p class="text-sm font-medium">{{ t('Actions') }}</p>
                <div class="flex gap-2">
                    <Button variant="outline" size="sm">{{ t('Edit') }}</Button>
                    <Button variant="outline" size="sm">{{ t('Save') }}</Button>
                    <Button variant="destructive" size="sm">{{ t('Delete') }}</Button>
                </div>
            </div>

            <div class="space-y-2">
                <p class="text-sm font-medium">Language / Nyelv</p>
                <div class="flex gap-2">
                    <Button
                        v-for="lang in languages"
                        :key="lang.code"
                        :variant="currentLocale === lang.code ? 'default' : 'outline'"
                        size="sm"
                        @click="changeLanguage(lang.code)"
                    >
                        {{ lang.name }}
                    </Button>
                </div>
            </div>
        </CardContent>
    </Card>
</template>

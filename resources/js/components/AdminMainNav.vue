<script setup lang="ts">
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@admin/components/ui/sidebar';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@admin/components/ui/collapsible';
import { useActiveUrl } from '@admin/composables/useActiveUrl';
import { useIconMap } from '@admin/composables/useIconMap';
import { useMenuState } from '@admin/composables/useMenuState';
import { type NavItem } from '@admin/types';
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronRight } from 'lucide-vue-next';
import { computed } from 'vue';

const page = usePage();
const items = computed(() => page.props.menu as NavItem[] || []);

const { urlIsActive } = useActiveUrl();
const { getIcon } = useIconMap();
const { isMenuOpen, setMenuOpen } = useMenuState();
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>Platform</SidebarGroupLabel>
        <SidebarMenu>
            <template v-for="item in items" :key="item.title">
                <!-- Menu item with children (collapsible) -->
                <Collapsible
                    v-if="item.items && item.items.length > 0"
                    as-child
                    :open="isMenuOpen(item.title, item.isActive)"
                    @update:open="(open) => setMenuOpen(item.title, open)"
                    class="group/collapsible"
                >
                    <SidebarMenuItem>
                        <CollapsibleTrigger as-child>
                            <SidebarMenuButton :tooltip="item.title">
                                <component v-if="getIcon(item.icon)" :is="getIcon(item.icon)" />
                                <span>{{ item.title }}</span>
                                <ChevronRight
                                    class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90"
                                />
                            </SidebarMenuButton>
                        </CollapsibleTrigger>
                        <CollapsibleContent>
                            <SidebarMenuSub>
                                <SidebarMenuSubItem
                                    v-for="subItem in item.items"
                                    :key="subItem.title"
                                >
                                    <SidebarMenuSubButton
                                        as-child
                                        :is-active="urlIsActive(subItem.href)"
                                    >
                                        <Link :href="subItem.href || '#'">
                                            <component v-if="getIcon(subItem.icon)" :is="getIcon(subItem.icon)" />
                                            <span>{{ subItem.title }}</span>
                                        </Link>
                                    </SidebarMenuSubButton>
                                </SidebarMenuSubItem>
                            </SidebarMenuSub>
                        </CollapsibleContent>
                    </SidebarMenuItem>
                </Collapsible>

                <!-- Simple menu item without children -->
                <SidebarMenuItem v-else>
                    <SidebarMenuButton
                        as-child
                        :is-active="item.href ? urlIsActive(item.href) : false"
                        :tooltip="item.title"
                    >
                        <Link :href="item.href || '#'">
                            <component v-if="getIcon(item.icon)" :is="getIcon(item.icon)" />
                            <span>{{ item.title }}</span>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </template>
        </SidebarMenu>
    </SidebarGroup>
</template>


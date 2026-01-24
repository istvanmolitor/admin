# Gyors Kezdés - Admin Package

Ez az útmutató lépésről lépésre bemutatja, hogyan használd az Admin csomagot a projektedben.

## 1. lépés: Resource-ok Publikálása

Először publikáld az összes szükséges resource-t:

```bash
# Publikáld az összes resource-t egyszerre
php artisan vendor:publish --tag=admin-all

# VAGY publikáld egyenként, amire szükséged van:
php artisan vendor:publish --tag=admin-config
php artisan vendor:publish --tag=admin-components
php artisan vendor:publish --tag=admin-ui
php artisan vendor:publish --tag=admin-lib
php artisan vendor:publish --tag=admin-composables
php artisan vendor:publish --tag=admin-styles
```

## 2. lépés: Tailwind Konfiguráció

Add hozzá az admin komponensek elérési útját a Tailwind konfigurációhoz (`tailwind.config.js`):

```javascript
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./resources/js/components/admin/**/*.vue",  // Admin komponensek
    "./resources/js/components/ui/**/*.vue",      // shadcn-vue komponensek
  ],
  // ... többi konfiguráció
}
```

## 3. lépés: CSS Importálása

Importáld az admin stílusokat az `resources/css/app.css` fájlba:

```css
@import './admin/admin.css';

/* vagy ha a publikálás előtt direkt a csomagból szeretnéd használni: */
/* @import '../../packages/admin/resources/css/admin.css'; */
```

## 4. lépés: TypeScript Alias Beállítása (opcionális)

Ha TypeScript-et használsz, frissítsd a `tsconfig.json` fájlt:

```json
{
  "compilerOptions": {
    "baseUrl": ".",
    "paths": {
      "@/*": ["./resources/js/*"],
      "@admin/*": ["./resources/js/components/admin/*"],
      "@ui/*": ["./resources/js/components/ui/*"]
    }
  }
}
```

Vagy a Vite konfigban (`vite.config.js`):

```javascript
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import { resolve } from 'path'

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': resolve(__dirname, './resources/js'),
      '@admin': resolve(__dirname, './resources/js/components/admin'),
      '@ui': resolve(__dirname, './resources/js/components/ui'),
    },
  },
})
```

## 5. lépés: Komponensek Használata

### Példa 1: Button Komponens

```vue
<script setup lang="ts">
import { Button } from '@/components/ui'
</script>

<template>
  <div class="p-4">
    <Button variant="default">Alap Gomb</Button>
    <Button variant="destructive">Törlés</Button>
    <Button variant="outline">Outline</Button>
    <Button variant="ghost">Ghost</Button>
  </div>
</template>
```

### Példa 2: Admin Komponensek Toast-tal

```vue
<script setup lang="ts">
import { AdminToaster, AdminMainNav } from '@/components/admin'
import { Button } from '@/components/ui'
import { useToast } from '@/composables/admin'

const { toast } = useToast()

const showSuccess = () => {
  toast({
    title: "Sikeres!",
    description: "A művelet sikeresen végrehajtva.",
    variant: "success"
  })
}

const showError = () => {
  toast({
    title: "Hiba!",
    description: "Valami hiba történt.",
    variant: "destructive"
  })
}
</script>

<template>
  <div>
    <AdminToaster />
    <AdminMainNav />
    
    <div class="p-4 space-x-2">
      <Button @click="showSuccess" variant="default">
        Sikeres Toast
      </Button>
      <Button @click="showError" variant="destructive">
        Hiba Toast
      </Button>
    </div>
  </div>
</template>
```

### Példa 3: Utility Függvények Használata

```vue
<script setup lang="ts">
import { computed } from 'vue'
import { cn } from '@/lib/utils'

const isActive = ref(true)

const buttonClass = computed(() => 
  cn(
    "px-4 py-2 rounded-md",
    isActive.value ? "bg-blue-500 text-white" : "bg-gray-200 text-gray-700"
  )
)
</script>

<template>
  <button :class="buttonClass">
    {{ isActive ? 'Aktív' : 'Inaktív' }}
  </button>
</template>
```

## 6. lépés: Konfiguráció Testreszabása

A `config/admin.php` fájlban testreszabhatod az admin panel beállításait:

```php
<?php

return [
    'name' => env('ADMIN_NAME', 'Admin Panel'),
    'prefix' => env('ADMIN_PREFIX', 'admin'),
    'middleware' => ['web', 'auth'],
    
    'dashboard' => [
        'enabled' => true,
        'route' => 'dashboard',
    ],
    
    'menu' => [
        'items' => [
            [
                'label' => 'Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'home',
            ],
            [
                'label' => 'Felhasználók',
                'route' => 'admin.users.index',
                'icon' => 'users',
            ],
            // ... további menüpontok
        ],
    ],
];
```

## 7. lépés: Build és Futtatás

```bash
# Telepítsd a függőségeket (ha még nem tetted)
npm install clsx tailwind-merge

# Build
npm run build

# Vagy dev módban
npm run dev
```

## Hasznos Parancsok

```bash
# Resource-ok újra publikálása (force)
php artisan vendor:publish --tag=admin-all --force

# Csak a komponensek újra publikálása
php artisan vendor:publish --tag=admin-components --force

# Cache törlése
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Frontend build
npm run build
```

## Hibaelhárítás

### "Module not found" hiba

Győződj meg róla, hogy:
1. Publikáltad a resource-okat
2. A Vite/TypeScript alias-ok helyesen vannak beállítva
3. Újraindítottad a dev szervert (`npm run dev`)

### Stílusok nem jelennek meg

1. Ellenőrizd, hogy importáltad-e az `admin.css` fájlt
2. Ellenőrizd a Tailwind konfigurációt
3. Futtasd újra: `npm run build`

### Tailwind osztályok nem működnek

Győződj meg róla, hogy a `tailwind.config.js` tartalmazza az admin komponensek elérési útját a `content` tömbben.

## Továbbiak

További információkért lásd:
- [README.md](./README.md) - Teljes dokumentáció
- [PUBLISH.md](./PUBLISH.md) - Publikálási részletek

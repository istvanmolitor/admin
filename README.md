# Admin UI Package

Admin UI csomag shadcn-vue komponensekkel, Vue 3 és TypeScript alapokon.

## Telepítés

A csomag automatikusan regisztrálódik a Laravel alkalmazásban az `AdminServiceProvider` segítségével.

### Middleware Regisztrálása

A `ShareAdminData` middleware-t regisztrálni kell az alkalmazás middleware stack-jében. Add hozzá a web middleware csoporthoz a `bootstrap/app.php` fájlban:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->web(append: [
        // ...other middleware...
        \Molitor\Admin\Middleware\ShareAdminData::class,
    ]);
})
```

Ez a middleware felelős az admin-hez kapcsolódó adatok megosztásáért az Inertia view-kkal.

## Resource-ok Publikálása

### Összes Resource Publikálása

```bash
php artisan vendor:publish --tag=admin-all
```

### Specifikus Resource-ok Publikálása

**Konfiguráció:**
```bash
php artisan vendor:publish --tag=admin-config
```

**Vue Komponensek:**
```bash
php artisan vendor:publish --tag=admin-components
```

**shadcn-vue UI Komponensek:**
```bash
php artisan vendor:publish --tag=admin-ui
```

**Utility Függvények:**
```bash
php artisan vendor:publish --tag=admin-lib
```

**Composables:**
```bash
php artisan vendor:publish --tag=admin-composables
```

**CSS Stílusok:**
```bash
php artisan vendor:publish --tag=admin-styles
```

**Blade Views:**
```bash
php artisan vendor:publish --tag=admin-views
```

**Public Assets:**
```bash
php artisan vendor:publish --tag=admin-public
```

### Felülírás Kényszerítése

Ha már létező fájlokat szeretnél újra publikálni:

```bash
php artisan vendor:publish --tag=admin-components --force
```

## Használat

### Vue Komponensek Importálása

```typescript
// Admin komponensek
import { 
  AdminToaster, 
  AdminMainNav, 
  AdminFilter,
  AdminPagination,
  AdminDeleteButton 
} from '@/components/admin'

// shadcn-vue UI komponensek
import { Button } from '@/components/ui'

// Utility függvények
import { cn } from '@/lib/utils'

// Composables
import { useToast } from '@/composables/admin'
```

### Példa Komponens Használat

```vue
<script setup lang="ts">
import { Button } from '@/components/ui'
import { AdminToaster } from '@/components/admin'
import { useToast } from '@/composables/admin'

const { toast } = useToast()

const handleClick = () => {
  toast({
    title: "Sikeres művelet",
    description: "Az adatok sikeresen mentve.",
    variant: "success"
  })
}
</script>

<template>
  <div>
    <AdminToaster />
    <Button @click="handleClick" variant="default">
      Mentés
    </Button>
  </div>
</template>
```

### CSS Stílusok Beillesztése

Az `app.css` vagy hasonló fájlban:

```css
@import './admin/admin.css';
```

## Csomag Struktúra

```
packages/admin/
├── resources/
│   ├── js/
│   │   ├── components/          # Admin komponensek
│   │   │   ├── AdminToaster.vue
│   │   │   ├── AdminMainNav.vue
│   │   │   ├── AdminFilter.vue
│   │   │   ├── AdminPagination.vue
│   │   │   ├── AdminDeleteButton.vue
│   │   │   ├── index.ts
│   │   │   └── ui/              # shadcn-vue komponensek
│   │   │       ├── button/
│   │   │       └── index.ts
│   │   ├── lib/                 # Utility függvények
│   │   │   └── utils.ts
│   │   ├── composables/         # Vue composables
│   │   │   ├── index.ts
│   │   │   └── useToast.ts
│   │   └── index.ts             # Fő belépési pont
│   ├── css/
│   │   └── admin.css            # shadcn-vue stílusok
│   ├── views/                   # Blade templates
│   └── public/                  # Publikus assets
├── src/
│   ├── config/
│   │   └── admin.php            # Konfiguráció
│   ├── Providers/
│   │   └── AdminServiceProvider.php
│   ├── Controllers/
│   ├── Middleware/
│   ├── Services/
│   └── routes/
├── composer.json
├── package.json
├── tsconfig.json
├── tailwind.config.js
└── README.md
```

## Fejlesztés

### Új UI Komponens Hozzáadása

1. Hozd létre a komponenst a `resources/js/components/ui/` mappában
2. Exportáld az `ui/index.ts` fájlban
3. Publikáld újra: `php artisan vendor:publish --tag=admin-ui --force`

### Új Composable Hozzáadása

1. Hozd létre a composable-t a `resources/js/composables/` mappában
2. Exportáld a `composables/index.ts` fájlban
3. Publikáld újra: `php artisan vendor:publish --tag=admin-composables --force`

### Stílusok Módosítása

1. Módosítsd a `resources/css/admin.css` fájlt
2. Publikáld újra: `php artisan vendor:publish --tag=admin-styles --force`

## Technológiák

- **Vue 3** - Progressive JavaScript framework
- **TypeScript** - Type-safe JavaScript
- **shadcn-vue** - Re-usable components built with Radix Vue and Tailwind CSS
- **Tailwind CSS** - Utility-first CSS framework
- **Laravel** - PHP framework

## Dokumentáció

További részletekért lásd a [PUBLISH.md](./PUBLISH.md) fájlt.

## Licensz

MIT

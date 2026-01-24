# Admin Package - Publish Resources

Ez a dokumentum ismerteti, hogyan lehet publikálni a fájlokat és resource elemeket az `admin` csomagból a fő projektbe.

## Publikálható Elemek

### 1. Konfiguráció
Publikálja az admin konfigurációs fájlt:
```bash
php artisan vendor:publish --tag=admin-config
```

Ez létrehozza a `config/admin.php` fájlt a projektben.

### 2. Vue Komponensek
Publikálja az Admin Vue komponenseket:
```bash
php artisan vendor:publish --tag=admin-components
```

Ez a következő komponenseket másolja át a `resources/js/components/admin/` mappába:
- AdminToaster.vue
- AdminMainNav.vue
- AdminFilter.vue
- AdminPagination.vue
- AdminDeleteButton.vue
- index.ts

### 3. shadcn-vue UI Komponensek
Publikálja a shadcn-vue UI komponenseket:
```bash
php artisan vendor:publish --tag=admin-ui
```

Ez a UI komponenseket másolja át a `resources/js/components/ui/` mappába.

### 4. Utility Függvények (lib)
Publikálja a TypeScript utility függvényeket:
```bash
php artisan vendor:publish --tag=admin-lib
```

Ez a `resources/js/lib/` mappába másolja az utility fájlokat (pl. utils.ts).

### 5. Vue Composables
Publikálja a Vue composable függvényeket:
```bash
php artisan vendor:publish --tag=admin-composables
```

Ez a `resources/js/composables/admin/` mappába másolja a composable fájlokat.

### 6. CSS Stílusok
Publikálja az admin CSS fájlokat:
```bash
php artisan vendor:publish --tag=admin-styles
```

Ez a `resources/css/admin/` mappába másolja a stílusfájlokat, beleértve a shadcn-vue kompatibilis stílusokat is.

### 7. Blade View-k
Publikálja a Blade template fájlokat:
```bash
php artisan vendor:publish --tag=admin-views
```

Ez a `resources/views/vendor/admin/` mappába másolja a view fájlokat.

### 8. Public Assets
Publikálja a publikus asset fájlokat:
```bash
php artisan vendor:publish --tag=admin-public
```

Ez a `public/vendor/admin/` mappába másolja a publikus fájlokat.

### 9. Összes Resource Publikálása Egyszerre
Publikálja az összes resource-t egyszerre:
```bash
php artisan vendor:publish --tag=admin-all
```

## Specifikus Fájlok Felülírása

Ha már publikálta a fájlokat és újra szeretné írni őket:
```bash
php artisan vendor:publish --tag=admin-components --force
```

## Használat a Projektben

### Vue Komponensek Importálása

```typescript
// Az admin komponensek importálása
import { AdminToaster, AdminMainNav, AdminFilter } from '@/components/admin'

// shadcn-vue UI komponensek importálása
import { Button, Card, Dialog } from '@/components/ui'

// Utility függvények használata
import { cn } from '@/lib/utils'

// Composables használata
import { useToast } from '@/composables/admin'
```

### CSS Stílusok Beillesztése

Az `app.css` vagy `app.js` fájlban:
```css
@import './admin/admin.css';
```

Vagy a Vite config-ban:
```javascript
// vite.config.js
export default {
  css: {
    preprocessorOptions: {
      css: {
        additionalData: `@import "./resources/css/admin/admin.css";`
      }
    }
  }
}
```

## Csomag Struktúra

```
packages/admin/
├── resources/
│   ├── js/
│   │   ├── components/
│   │   │   ├── AdminToaster.vue
│   │   │   ├── AdminMainNav.vue
│   │   │   ├── AdminFilter.vue
│   │   │   ├── AdminPagination.vue
│   │   │   ├── AdminDeleteButton.vue
│   │   │   ├── index.ts
│   │   │   └── ui/
│   │   │       └── index.ts (shadcn-vue komponensek)
│   │   ├── lib/
│   │   │   └── utils.ts
│   │   └── composables/
│   │       ├── index.ts
│   │       └── useToast.ts
│   ├── css/
│   │   └── admin.css
│   ├── views/
│   └── public/
└── src/
    ├── config/
    │   └── admin.php
    └── Providers/
        └── AdminServiceProvider.php
```

## Fejlesztési Útmutató

1. **Új UI Komponens Hozzáadása:**
   - Hozza létre a komponenst a `resources/js/components/ui/` mappában
   - Exportálja az `ui/index.ts` fájlban
   - Publikálja újra: `php artisan vendor:publish --tag=admin-ui --force`

2. **Új Composable Hozzáadása:**
   - Hozza létre a composable-t a `resources/js/composables/` mappában
   - Exportálja a `composables/index.ts` fájlban
   - Publikálja újra: `php artisan vendor:publish --tag=admin-composables --force`

3. **Stílusok Módosítása:**
   - Módosítsa az `resources/css/admin.css` fájlt
   - Publikálja újra: `php artisan vendor:publish --tag=admin-styles --force`

## Megjegyzések

- A csomagban Vue 3 és TypeScript alapon fejlesztünk
- A shadcn-vue komponensek Tailwind CSS-t használnak
- Minden publikált fájl a fő projekt `resources/` mappájába kerül
- A konfiguráció a `config/` mappába kerül
- A publikus asset-ek a `public/vendor/admin/` mappába kerülnek

# Changelog

## [1.0.0] - 2026-01-24

### Hozzáadva
- **AdminServiceProvider** teljes körű publish támogatás
  - `admin-config` - Konfiguráció publikálása
  - `admin-components` - Vue komponensek publikálása
  - `admin-ui` - shadcn-vue UI komponensek publikálása
  - `admin-lib` - Utility függvények publikálása
  - `admin-composables` - Vue composables publikálása
  - `admin-styles` - CSS stílusok publikálása
  - `admin-views` - Blade templates publikálása
  - `admin-public` - Publikus assets publikálása
  - `admin-all` - Összes resource egyszerre

- **shadcn-vue integráció**
  - `resources/js/lib/utils.ts` - cn() utility függvény
  - `resources/css/admin.css` - shadcn-vue kompatibilis stílusok
  - `resources/js/components/ui/` - UI komponensek struktúra
  - `resources/js/components/ui/button/Button.vue` - Példa Button komponens

- **TypeScript támogatás**
  - `tsconfig.json` - TypeScript konfiguráció
  - Type-safe komponensek és composables
  - Teljes TypeScript coverage

- **Vue Composables**
  - `useToast.ts` - Toast notification kezelés
  - Exportált composables index

- **Dokumentáció**
  - `README.md` - Teljes körű dokumentáció magyarul
  - `PUBLISH.md` - Részletes publish útmutató
  - `QUICKSTART.md` - Gyors kezdés útmutató
  - `CHANGELOG.md` - Változások nyomonkövetése

- **Konfiguráció fájlok**
  - `package.json` - NPM függőségek (clsx, tailwind-merge)
  - `tailwind.config.js` - Tailwind CSS konfiguráció shadcn-vue-hoz
  - `.gitignore` - Git ignore szabályok

- **Projekt struktúra**
  - `resources/js/components/` - Admin komponensek
  - `resources/js/components/ui/` - shadcn-vue UI komponensek
  - `resources/js/lib/` - Utility függvények
  - `resources/js/composables/` - Vue composables
  - `resources/css/` - Stílusok
  - `resources/views/` - Blade templates
  - `resources/public/` - Publikus assets

### Módosítva
- **AdminServiceProvider** újrastrukturálva
  - Új `registerPublishables()` metódus
  - Feltételes directory ellenőrzések
  - Tisztább, karbantarthatóbb kód

### Megjegyzések
- Vue 3 és TypeScript alapok
- shadcn-vue kompatibilis komponensek
- Laravel package best practices követése
- Teljes magyar nyelvű dokumentáció

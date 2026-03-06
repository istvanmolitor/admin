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

## Routing

Az admin csomag egy Single Page Application-t (SPA) valósít meg az `/admin` prefix alatt. Minden admin oldal ezen a prefix-en keresztül érhető el.

### Backend Routing

A Laravel backend minden `/admin/*` útvonalat a `DashboardController`-re irányít, ami a Vue SPA-t szolgálja ki. Ez a routing a `packages/admin/src/routes/web.php` fájlban van definiálva.

### Frontend Routing

A Vue router az alábbi útvonalakat biztosítja az admin felületen:

**Auth útvonalak:**
- `/admin/login` - Admin bejelentkezés
- `/admin/forgot-password` - Jelszó visszaállítás
- `/admin/logout` - Kijelentkezés
- `/admin/profile` - Felhasználói profil
- `/admin/change-password` - Jelszó módosítás

**Dashboard:**
- `/admin` - Admin dashboard (alapértelmezett admin oldal)

**Felhasználó kezelés:**
- `/admin/users` - Felhasználók listája
- `/admin/users/create` - Új felhasználó létrehozása
- `/admin/users/:id/edit` - Felhasználó szerkesztése

**Felhasználói csoportok:**
- `/admin/user-groups` - Felhasználói csoportok listája
- `/admin/user-groups/create` - Új csoport létrehozása
- `/admin/user-groups/:id/edit` - Csoport szerkesztése

**Jogosultságok:**
- `/admin/permissions` - Jogosultságok listája
- `/admin/permissions/create` - Új jogosultság létrehozása
- `/admin/permissions/:id/edit` - Jogosultság szerkesztése

Minden admin útvonal megköveteli az autentikációt és az admin szerepkört, kivéve az auth oldalakat (login, forgot-password).

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

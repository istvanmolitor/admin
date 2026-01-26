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

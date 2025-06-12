# Admin

## Előfeltételek

Telepíteni kell a következő modulokat.:
- https://gitlab.com/molitor/menu
- https://gitlab.com/molitor/data_table

## Telepítés

### Provider regisztrálása
config/app.php
```php
'providers' => ServiceProvider::defaultProviders()->merge([
    /*
    * Package Service Providers...
    */
    \Molitor\Admin\Providers\AdminServiceProvider::class,
])->toArray(),
```

### Kliens scriptek publikálása

```shell
php artisan vendor:publish
```
Válaszd a következőt: admin-public

### Breadcrumb telepítése

A admin modul breadcrumbs.php fileját regisztrálni kell a configs/breadcrumbs.php fileban.
```php
<?php
'files' => [
    base_path('/vendor/molitor/admin/src/routes/breadcrumbs.php'),
],
```

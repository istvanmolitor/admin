# Admin

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

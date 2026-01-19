# Admin UI

## Installation

### Register Middleware

The `ShareAdminData` middleware must be registered in your application's middleware stack. Add it to the web middleware group in `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->web(append: [
        // ...other middleware...
        \Molitor\Admin\Middleware\ShareAdminData::class,
    ]);
})
```

This middleware is responsible for sharing admin-related data with your Inertia views.



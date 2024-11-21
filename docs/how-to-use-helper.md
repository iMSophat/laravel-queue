
### Parameters

- `{name}`: The name of the helper class you want to create. You can specify a nested structure by using slashes (`/`). For example:
  - `MyHelper` will create a file named `MyHelper.php` in the `app/Helpers` directory.
  - `MyNamespace/MyHelper` will create a file named `MyHelper.php` in the `app/Helpers/MyNamespace` directory.

## Example Usage

1. **Create a Simple Helper Class:**

   To create a helper class named `MyHelper`, run the following command:

```bash
php artisan helper:name MyHelper
```

   This will create a file at `app/Helpers/MyHelper.php`.

2. **Create a Namespaced Helper Class:**

   To create a namespaced helper class, use slashes in the name:

```bash
php artisan helper:name MyNamespace/MyHelper
```

   This will create a file at `app/Helpers/MyNamespace/MyHelper.php`.

# Tenant

Tenant allows for storing configuration settings in the database. This package is perfect for multitenant applications.

## Status

This package is a work-in-progress and is not yet recommended for production use.

## Installation

Install via Composer:

```
$ composer require "karlmonson/tenant": "~1.0"
```

## Configuration

Register the Service Provider:

```php
Karlmonson\Tenant\TenantServiceProvider::class,
```

Then register the Facade:

```php
'Tenant' => Karlmonson\Tenant\Facades\Tenant::class,
```

Then run migrations to create the Tenant database table:

```
php artisan migrate
```

## Usage

### Seeding

To get started you may use the TenantTableSeeder provided by running the following command:

```
php artisan tenant:seed
```

This will seed the Tenant table with the default 3rd party config variables found the in `.env` file.

### Creating/Updating Keys

To store a new key/value in the Tenant table, you may use the `set` method on the Tenant Facade:

```php
<?php

namespace App;

use Karlmonson\Tenant\Facades\Tenant;

class Store
{
    public function setKey($key, $value, $encrypt = false, $env = false)
    {
        Tenant::set($key, $value, $encrypt, $env);
    }
}
```

The `set` function will both store a new key/value pair as well as update an already existing pair.

If the `encrypt` flag is set to `true`, the value will be stored using the Laravel `encrypt()` method. When you retrieve the value from Tenant, it will automatically filter through the `decrypt()` method. It is recommended to always use the `encrypt` flag for Passwords, API Secrets, and any other sensitive information.

If the `env` flag is set to `true`, it will let Tenant know that it is a System/Package config option that should be used in place of setting the value in the `.env` file.

You may also use the Artisan command to set/update keys:

```
php artisan tenant:set key value --encrypt=0|1 --environment=0|1
```

### Retrieving Keys

To retrieve a key/value pair in the Tenant table, you may use the `get` method on the Tenant Facade:

```php
<?php

namespace App;

use Karlmonson\Tenant\Facades\Tenant;

class Store
{
    public function getKey($key, $default = null)
    {
        Tenant::get($key, $default);
    }
}
```

The `get` method functions similarly to the `Config::get()` method by allowing you to pass a default value that will be returned if the value of the key is null or if the key does not exist.

You may also use the Artisan command to get keys, practical for testing/debugging purposes:

```
php artisan tenant:get key
```

Or you may also list all the keys in the Tenant table with the following command:

```
php artisan tenant:list
```

### Using the Stored Config Values

This is probably the most important part of Tenant, and certainly the most magical.

When using Tenant for 3rd party services, you may use the values by calling the `swapConfig` method on the Tenant Facade:

```php
<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Karlmonson\Tenant\Facades\Tenant;

class TestController extends Controller
{
    public function sendMail()
    {
        Tenant::swapConfig();
        
        Mail::to('test@example.com')->send(new TestMail());
    }
}
```

The `swapConfig` method will load the stored values into their respective configs for the current request. They are not permanently added to the configs making it still possible to use the values from the `.env` file if you so desire.

In order for the key/values stored in Tenant to be swapped successfully, the must follow the same structure as listed in the `.env` file. (i.e. MAIL_DRIVER or REDIS_HOST)

## Contributing

Thank you for being willing to contribute to Tenant. You can read the contribution guidelines [here](contributing.md).

## Credits

- [Karl Monson](https://github.com/karlmonson) - Author

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
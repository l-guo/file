# Laravel 5.3 Vendor Package Example
### An example on how-to create a vendor package for Composer

"Packages are the primary way of adding functionality to Laravel. Packages might be anything from a great way to work with dates like Carbon, or an entire BDD testing framework like Behat."
https://laravel.com/docs/master/packages

Use this package to help develop new packages to share among your projects -- or the world.

# Installation
1. Clone this repo.

3. Add to https://packagist.org.
4. Using your details, install with commands below.

# Installation

composer require guo/file "dev-master"

## Register with config/app.php
Register the service providers to enable the package:
```
Guo\File\Providers\AppServiceProvider::class,
```

```
php artisan vendor:publish
```

# Orphan Controller

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryangjchandler/laravel-orphan-controller.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/laravel-orphan-controller)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/laravel-orphan-controller/run-tests?label=tests)](https://github.com/ryangjchandler/laravel-orphan-controller/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/laravel-orphan-controller/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ryangjchandler/laravel-orphan-controller/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ryangjchandler/laravel-orphan-controller.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/laravel-orphan-controller)

Quickly identify controller methods with no route in your Laravel applications.

## Installation

You can install the package via Composer:

```bash
composer require ryangjchandler/laravel-orphan-controller --dev
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="RyanChandler\LaravelOrphanController\LaravelOrphanControllerServiceProvider" --tag="orphan-controller-config"
```

This is the contents of the published config file:

```php
return [

    'paths' => [
        app_path('Http/Controllers'),
    ],

];
```

## Usage

This package provides a single Artisan command - `orphan-controller:find`.

You can run this command in your terminal:

```bash
php artisan orphan-controller:find
```

By default, it will look through each path inside of the `orphan-controller.paths` configuration value.

When an orphaned controller method is discovered, it will be added to a table and printed in your console:

![Screenshot of Table Output](https://i.ibb.co/MNC2j7t/Clean-Shot-2021-05-19-at-17-40-57.png)

You can also use the `--compact` flag to output a more compact table:

![Screenshot of Compact Table Output](https://i.ibb.co/QY706yk/Clean-Shot-2021-05-19-at-17-42-09.png)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ryan Chandler](https://github.com/ryangjchandler)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

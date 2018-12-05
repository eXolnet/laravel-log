# Laravel Log

[![Latest Stable Version](https://poser.pugx.org/eXolnet/laravel-log/v/stable?format=flat-square)](https://packagist.org/packages/eXolnet/laravel-log)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/eXolnet/laravel-log/master.svg?style=flat-square)](https://travis-ci.org/eXolnet/laravel-log)
[![Total Downloads](https://img.shields.io/packagist/dt/eXolnet/laravel-log.svg?style=flat-square)](https://packagist.org/packages/eXolnet/laravel-log)

This package extends Laravel’s log package to configure a Monolog driver. As of Laravel 5.6, this package is not required anymore since it’s now natively supported by Laravel.

## Installation

1. Require this package with composer:

    ```
    composer require exolnet/laravel-log
    ```

2. If you don't use package auto-discovery, add the service provider to the ``providers`` array in `config/app.php`:

    ```
    Exolnet\Log\LogServiceProvider::class
    ```
    
3. Add your Monolog host to your `.env`:

    ```
    LOG_MONOLOG_HOST=localhost
    ```

## Usage

When this package is installed and configured, all Laravel exceptions will be forwarded to your Monolog installation.

To ensure that the setup is working properly, trigger an exception and verify that the error was received.

## Testing

To run the phpUnit tests, please use:

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE OF CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email security@exolnet.com instead of using the issue tracker.

## Credits

- [Tom Rochette](https://github.com/tomzx)
- [Alexandre D'Eschabeault](https://github.com/xel1045)
- [All Contributors](../../contributors)

## License

This code is licensed under the [MIT license](http://choosealicense.com/licenses/mit/). 
Please see the [license file](LICENSE) for more information.

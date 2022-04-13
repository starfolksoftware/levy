# Introduction


## Installation

You can install the package via composer:

```bash
composer require starfolksoftware/levy
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="levy-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="levy-config"
```

This is the contents of the published config file:

```php
return [
    'middleware' => ['web'],

    'redirects' => [
        'store' => null,
        'update' => null,
        'destroy' => '/',
    ],
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="levy-views"
```

## Usage

```php
$levy = new StarfolkSoftware\Levy();
echo $levy->echoPhrase('Hello, StarfolkSoftware!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Faruk Nasir](https://github.com/starfolksoftware)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

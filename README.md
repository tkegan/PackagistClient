# PackagistClient

## About

A client library for working with the Packagist REST API in PHP.

## Author

Tom Egan <tom@tomegan.tech>

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Testing

A unit test suite is included for testing PHP code. To use it you will need `phpunit` and to generate the PSR-4 autoload map. This can be done using `composer`. To get `composer` follow the instructions for your os on https://getcomposer.org. With `composer` installed, simply change into the project directory and run `composer install`. You can then run tests using `phpunit` installed by `composer`.

```sh
cd ${PROJECT_DIRECTORY}
composer install
vendor/bin/phpunit test
```

## Contributing

Did you find a bug? Feel free to open an [issue](https://github.com/tkegan/PackagistClient/issues). Got a fix or an enhancement coded up? Yeah I'd like a look; please open a [pull request](https://github.com/tkegan/PackagistClient/pulls).

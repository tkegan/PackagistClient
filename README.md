# PackagistClient

## About

A client library for working with the Packagist REST API in PHP.

Please note that this library is being provided to you not by the folks behind [Pakagist.org](https://packagist.org/) but by some one who read the API docs and thought it would be useful to have a library to ease making use of the API. As such this library is not endorsed by Packagist and is liable to break if Packagist changes their API.

## Author

Tom Egan <tom@tomegan.tech>

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Installation

Install the latest version with

```sh
$ composer require tomegantech/packagist-client
```

## Usage

The library is used by creating an instance of `PackagistClient` and invoking one of the API cover methods:

- `listPackages(string|null $organization, string|null $type)`
- `listSecurityAdvisories(DateTime|null $since, string[]|null $packages)`
- `searchPackages(string|null $term, string|null $tag, string|null $type)`

For example:

```php
use GuzzleHttp\Client as HttpClient;
use TomEganTech\PackagistClient\PackagistClient;

...

$client = new PackagistClient(new HttpClient());
$securityAdvisories = $client->listSecurityAdvisories(null, ['monolog/monolog']);
```

Also check out `test/PackagistClientTest.php` for more examples.

## Testing

A unit test suite is included for testing PHP code. To use it you will need `phpunit` and to generate the PSR-4 autoload map. This can be done using `composer`. To get `composer` follow the instructions for your os on https://getcomposer.org. With `composer` installed, simply change into the project directory and run `composer install`. You can then run tests using `phpunit` installed by `composer`.

```sh
cd ${PROJECT_DIRECTORY}
composer install
vendor/bin/phpunit test
```

## Contributing

Did you find a bug? Feel free to open an [issue](https://github.com/tkegan/PackagistClient/issues). Got a fix or an enhancement coded up? Yeah I'd like a look; please open a [pull request](https://github.com/tkegan/PackagistClient/pulls).

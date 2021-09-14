# digisign

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![CI](https://github.com/digitalcz/digisign/workflows/CI/badge.svg)]()
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/digitalcz/digisign/badges/quality-score.png?b=1.x)](https://scrutinizer-ci.com/g/digitalcz/digisign/?branch=1.x)
[![codecov](https://codecov.io/gh/digitalcz/digisign/branch/master/graph/badge.svg)](https://codecov.io/gh/digitalcz/digisign)
[![Total Downloads][ico-downloads]][link-downloads]

[DigiSign](https://www.digisign.cz) PHP library - provides communication with https://api.digisign.org in PHP using PSR-18 HTTP Client, PSR-17 HTTP Factories and PSR-16 SimpleCache.

API documentation is here https://api.digisign.org/api/docs

## Install

Via [Composer](https://getcomposer.org/)

```bash
$ composer require digitalcz/digisign
```

## Configuration

#### Example configuration in PHP

```php
use DigitalCz\DigiSign\Auth\ApiKeyCredentials;
use DigitalCz\DigiSign\DigiSign;

// Via constructor options
$dgs = new DigiSign([
    'access_key' => '...', 
    'secret_key' => '...'
]);

// Or via methods
$dgs = new DigiSign();
$dgs->setCredentials(new ApiKeyCredentials('...', '...'));
```

#### Available constructor options
*  `access_key`          - string; ApiKey access key
*  `secret_key`          - string; ApiKey secret key
*  `credentials`         - DigitalCz\DigiSign\Auth\Credentials instance
*  `client`              - DigitalCz\DigiSign\DigiSignClient instance with your custom PSR17/18 objects
*  `http_client`         - Psr\Http\Client\ClientInterface instance of your custom PSR18 client
*  `cache`               - Psr\SimpleCache\CacheInterface for caching Credentials Tokens
*  `testing`             - bool; whether to use testing or production API
*  `api_base`            - string; override the base API url
*  `signature_tolerance` - int; The tolerance for webhook signature age validation (in seconds)

#### Available configuration methods

```php
use DigitalCz\DigiSign\Auth\Token;
use DigitalCz\DigiSign\Auth\TokenCredentials;
use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\DigiSignClient;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\HttpClient\Psr18Client;

$dgs = new DigiSign();
// To set your own PSR-18 HTTP Client, if not provided Psr18ClientDiscovery is used
$dgs->setClient(new DigiSignClient(new Psr18Client()));
// If you already have the auth-token, i can use TokenCredentials
$dgs->setCredentials(new TokenCredentials(new Token('...', 123)));
// Cache will be used to store auth-token, so it can be reused in later requests
$dgs->setCache(new Psr16Cache(new FilesystemAdapter()));
// Use testing API (https://api.digisign.digital.cz)
$dgs->useTesting(true);
// Overwrite API base
$dgs->setApiBase('https://example.com/api');
// Set maximum age of webhook request to one minute
$dgs->setSignatureTolerance(60);
```

#### Example configuration in Symfony

```yaml
services:
  DigitalCz\DigiSign\DigiSign:
    $options:
      # minimal config
      access_key: '%digisign.accessKey%'
      secret_key: '%digisign.secretKey%'
      
      # other options
      cache: '@psr16.cache'
      http_client: '@psr18.http_client'
      testing: true # use testing API
```

## Usage

#### Create and send Envelope

```php
$dgs = new DigitalCz\DigiSign\DigiSign(['access_key' => '...', 'secret_key' => '...']);

$envelopes = $dgs->envelopes();

$envelope = $envelopes->create([
    'emailSubject' => 'Please sign',
    'emailBody' => 'Hello James, please sign these documents.',
    'senderName' => 'John Smith',
    'senderEmail' => 'john.smith@example.com'
]);

$recipient = $envelopes->recipients($envelope)->create([
    'role' => 'signer',
    'name' => 'James Brown',
    'email' => 'james42@example.com',
    'mobile' => '+420775300500',
]);

$stream = DigitalCz\DigiSign\Stream\FileStream::open('path/to/document.pdf');
$file = $dgs->files()->upload($stream);

$document = $envelopes->documents($envelope)->create([
    'name' => 'Contract',
    'file' => $file->self()
]);

$tag = $envelopes->tags($envelope)->create([
    'type' => 'signature',
    'document' => $document,
    'recipient' => $recipient,
    'page' => 1,
    'xPosition' => 200,
    'yPosition' => 340
]);

$envelopes->send($envelope->id());
```

See [examples](examples) for more

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer csfix    # fix codestyle
$ composer checks   # run all checks 

# or separately
$ composer tests    # run phpunit
$ composer phpstan  # run phpstan
$ composer cs       # run codesniffer
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email devs@digital.cz instead of using the issue tracker.

## Credits

- [Digital Solutions s.r.o.][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/digitalcz/digisign.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/digitalcz/digisign.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/digitalcz/digisign
[link-downloads]: https://packagist.org/packages/digitalcz/digisign
[link-author]: https://github.com/digitalcz
[link-contributors]: ../../contributors
